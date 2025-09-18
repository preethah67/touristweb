<?php
// Include config if needed for sessions or database connections on this page
include_once 'config.php'; 

// You can add PHP logic here later for form submission handling
// For example, checking if a login/register form was submitted,
// processing data, and redirecting. For now, it's a static page.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register - Travel Explorer</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Specific styles for the login/register container */
        .auth-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
        }
        .auth-tab-btn {
            background-color: #e9ecef;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            color: #495057;
            border-radius: 5px 5px 0 0;
            transition: background-color 0.3s ease, color 0.3s ease;
            flex-grow: 1; /* Make buttons take equal space */
            text-align: center;
        }
        .auth-tab-btn.active {
            background-color: #007bff;
            color: white;
        }
        .auth-tab-btn:hover:not(.active) {
            background-color: #dee2e6;
        }
        .auth-form-content {
            display: none;
        }
        .auth-form-content.active {
            display: block;
        }
        .auth-container p { /* Adjusting spacing for internal links/text */
            margin-top: 15px;
            font-size: 0.9em;
        }
        .auth-container a { /* Style for links within the auth container */
            color: #007bff;
            text-decoration: none;
        }
        .auth-container a:hover {
            text-decoration: underline;
        }

        /* Inherits form-container styles from style.css */
        .form-container {
            margin-top: 50px; /* Give some space from the top */
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">Travel Explorer</a> </div>
            <ul class="nav-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="destinations.php">Destinations</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="booking.php">Bookings</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="login.php" class="active">Login/Register</a></li> <li><a href="admin.php">Admin Panel</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="form-container">
            <div class="auth-tabs">
                <button class="auth-tab-btn active" onclick="showForm('login')">Login</button>
                <button class="auth-tab-btn" onclick="showForm('register')">Register</button>
            </div>

            <div id="loginFormContent" class="auth-form-content active">
                <h1>Login to Your Account</h1>
                <form action="process_login.php" method="POST"> <label for="loginUsername">Username or Email:</label>
                    <input type="text" id="loginUsername" name="username" placeholder="Enter your username or email" required>

                    <label for="loginPassword">Password:</label>
                    <input type="password" id="loginPassword" name="password" placeholder="Enter your password" required>

                    <input type="submit" value="Login">
                    <p><a href="#">Forgot Password?</a></p>
                </form>
            </div>

            <div id="registerFormContent" class="auth-form-content">
                <h1>Create a New Account</h1>
                <form action="process_register.php" method="POST"> <label for="regName">Full Name:</label>
                    <input type="text" id="regName" name="full_name" placeholder="Enter your full name" required>

                    <label for="regEmail">Email:</label>
                    <input type="email" id="regEmail" name="email" placeholder="Enter your email address" required>

                    <label for="regUsername">Username:</label>
                    <input type="text" id="regUsername" name="username" placeholder="Choose a username" required>

                    <label for="regPassword">Password:</label>
                    <input type="password" id="regPassword" name="password" placeholder="Create a password" required>

                    <label for="regConfirmPassword">Confirm Password:</label>
                    <input type="password" id="regConfirmPassword" name="confirm_password" placeholder="Confirm your password" required>

                    <input type="submit" value="Register">
                </form>
            </div>

            <p style="text-align: center; margin-top: 30px;"><a href="index.php">Back to Home</a></p>
        </div>
    </main>

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
            <?php
            // These variables would typically come from config.php or a database
            $adminName = "Travel Explorer Admin"; // Placeholder
            $adminEmail = "info@travelexplorer.com"; // Placeholder
            $adminPhone = "+91 98765 43210"; // Placeholder
            ?>
            <p>Admin: <?php echo $adminName; ?></p>
            <p>Email: <a href="mailto:<?php echo $adminEmail; ?>"><?php echo $adminEmail; ?></a></p>
            <p>Phone: <?php echo $adminPhone; ?></p>
            <p>&copy; <?php echo date("Y"); ?> Travel Explorer. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function showForm(formId) {
            // Hide all form contents
            document.querySelectorAll('.auth-form-content').forEach(content => {
                content.classList.remove('active');
            });
            // Deactivate all tab buttons
            document.querySelectorAll('.auth-tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show the selected form content
            document.getElementById(formId + 'FormContent').classList.add('active');
            // Activate the clicked tab button
            document.querySelector(`.auth-tab-btn[onclick*="${formId}"]`).classList.add('active');
        }

        // Show login form by default when page loads
        document.addEventListener('DOMContentLoaded', () => {
            showForm('login');
        });
    </script>
</body>
</html>