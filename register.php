<?php
include_once 'config.php'; // Include the database connection

$message = ''; // To display success or error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Get and sanitize input
    $fname = trim($_POST['fname'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $phone = trim($_POST['phone'] ?? ''); // Phone is int in DB, but received as string

    // 2. Server-side Validation
    if (empty($fname) || empty($password) || empty($email) || empty($city) || empty($phone)) {
        $message = '<p class="error">All fields are required.</p>';
    } elseif ($password !== $confirm_password) {
        $message = '<p class="error">Passwords do not match.</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<p class="error">Invalid email format.</p>';
    } elseif (!preg_match('/^[0-9]{10,15}$/', $phone)) { // Basic phone number pattern (10-15 digits)
        $message = '<p class="error">Phone number must be between 10 and 15 digits.</p>';
    } else {
        // All validation passed, proceed with database insertion

        // Convert phone to integer after validation if required by DB type (though varchar is often better)
        $phone_int = intval($phone); // Ensures it fits into INT(15) if database expects it

        // Check if username or email already exists
        $sql_check = "SELECT id FROM `customer` WHERE fname = ? OR email = ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        if ($stmt_check) {
            mysqli_stmt_bind_param($stmt_check, "ss", $fname, $email);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);

            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                $message = '<p class="error">Username or Email already registered. Please choose another.</p>';
            } else {
                // Hash the password for security before storing (HIGHLY RECOMMENDED)
                // In your travel.sql, 'password' is varchar(20). For hashing, it needs to be much longer (e.g., varchar(255)).
                // For now, storing plain as per your sample, but this is a major security risk.
                // Ideal: $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); // TEMPORARY: Storing plain password as per DB schema
                                             // For a real-world app, you MUST use password_hash() and change DB column to VARCHAR(255)

                // Insert user into database using prepared statement
                $sql_insert = "INSERT INTO `customer` (`fname`, `password`, `email`, `city`, `phone`) VALUES (?, ?, ?, ?, ?)";
                $stmt_insert = mysqli_prepare($conn, $sql_insert);

                if ($stmt_insert) {
                    mysqli_stmt_bind_param($stmt_insert, "ssssi", $fname, $hashed_password, $email, $city, $phone_int);

                    if (mysqli_stmt_execute($stmt_insert)) {
                        $message = '<p class="success">Registration successful! You can now <a href="login.php">login</a>.</p>';
                        // Clear form fields on success
                        $fname = $email = $city = $phone = '';
                    } else {
                        $message = '<p class="error">Error: ' . mysqli_stmt_error($stmt_insert) . '</p>';
                    }
                    mysqli_stmt_close($stmt_insert);
                } else {
                    $message = '<p class="error">Database insertion preparation failed: ' . mysqli_error($conn) . '</p>';
                }
            }
            mysqli_stmt_close($stmt_check);
        } else {
            $message = '<p class="error">Database check preparation failed: ' . mysqli_error($conn) . '</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Travel Explorer</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Specific styles for Login/Register forms */
        .auth-container {
            max-width: 500px;
            margin: 60px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .auth-container h2 {
            color: var(--primary-blue);
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"] {
            width: calc(100% - 22px); /* Account for padding and border */
            padding: 12px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            font-family: "Times New Roman", serif;
        }
        .auth-container button {
            background-color: var(--accent-orange);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }
        .auth-container button:hover {
            background-color: #e65c00;
        }
        .auth-container .link-text {
            margin-top: 20px;
            font-size: 0.95em;
            color: #666;
        }
        .auth-container .link-text a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: bold;
        }
        .auth-container .link-text a:hover {
            text-decoration: underline;
        }
        .success {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">Travel Explorer</a>
            </div>
            <ul class="nav-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="destinations.php">Destinations</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="booking.php">Bookings</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="login.php" class="active">Login/Register</a></li>
                <li><a href="admin.php">Admin Panel</a></li>
            </ul>
        </nav>
    </header>

    <div class="auth-container">
        <h2>Register New Account</h2>
        <?php echo $message; // Display messages here ?>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="fname">Username:</label>
                <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($fname ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <p class="link-text">Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <div class="live-chat-button">
        <button onclick="openChat()">Live Chat</button>
    </div>

    <footer class="main-footer">
        <nav class="footer-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="destinations.php">Destinations</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
            </ul>
        </nav>
        <div class="contact-info">
            <p>Admin: <?php echo $adminName; ?></p>
            <p>Email: <a href="mailto:<?php echo $adminEmail; ?>"><?php echo $adminEmail; ?></a></p>
            <p>Phone: <?php echo $adminPhone; ?></p>
            <p>&copy; <?php echo date("Y"); ?> Travel Explorer. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function openChat() {
            alert('Opening live chat... (Integration with a chat service will go here)');
        }
    </script>
</body>
</html>
<?php
mysqli_close($conn); // Close the database connection
?>