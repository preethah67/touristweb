<?php
include_once 'config.php'; // Include the database connection and global configs

// Get the destination ID from the URL
$destination_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Ensure it's an integer for safety

$destination = null;

if ($destination_id > 0) {
    // Prepare a statement to prevent SQL injection
    $sql = "SELECT * FROM `information` WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the ID parameter
        mysqli_stmt_bind_param($stmt, "i", $destination_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Fetch the destination data
        if ($result && mysqli_num_rows($result) > 0) {
            $destination = mysqli_fetch_assoc($result);
        } else {
            // No destination found with that ID
            $error_message = "Destination not found.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Database query preparation failed: " . mysqli_error($conn);
    }
} else {
    $error_message = "Invalid destination ID provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $destination ? htmlspecialchars($destination['pname']) . ' - Travel Explorer' : 'Destination Not Found'; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Specific styles for destination detail page */
        .destination-header {
            text-align: center;
            padding: 50px 20px 30px;
            background-color: var(--background-light);
        }
        .destination-header h1 {
            font-size: 3em;
            color: var(--primary-blue);
            margin-bottom: 10px;
        }
        .destination-content {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
        }
        .main-image-container {
            flex: 2;
            min-width: 300px; /* Minimum width for the image */
        }
        .main-image-container img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            object-fit: cover;
        }
        .details-text {
            flex: 3;
            min-width: 300px; /* Minimum width for the text */
            text-align: left;
        }
        .details-text h2 {
            font-size: 2.2em;
            color: var(--accent-orange);
            margin-top: 0;
            margin-bottom: 20px;
        }
        .details-text p {
            font-size: 1.1em;
            color: #555;
            margin-bottom: 20px;
        }
        .details-text .package-info {
            font-size: 1.4em;
            font-weight: bold;
            color: var(--primary-blue);
            margin-bottom: 30px;
        }
        .thumbnail-gallery {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .thumbnail-gallery img {
            width: 150px; /* Fixed width for thumbnails */
            height: 100px; /* Fixed height for thumbnails */
            object-fit: cover;
            border: 2px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: border-color 0.3s ease, transform 0.2s ease;
        }
        .thumbnail-gallery img:hover {
            border-color: var(--accent-orange);
            transform: scale(1.05);
        }
        .book-now-btn {
            background-color: var(--accent-orange);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.2em;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
            margin-top: 20px;
        }
        .book-now-btn:hover {
            background-color: #e65c00;
            transform: translateY(-2px);
        }
        .error-message {
            text-align: center;
            padding: 80px 20px;
            font-size: 1.5em;
            color: red;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .destination-content {
                flex-direction: column;
                gap: 20px;
            }
            .main-image-container, .details-text {
                min-width: unset;
                width: 100%;
            }
            .thumbnail-gallery img {
                width: 100px;
                height: 70px;
            }
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
                <li><a href="destinations.php" class="active">Destinations</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="booking.php">Bookings</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="login.php">Login/Register</a></li>
                <li><a href="admin.php">Admin Panel</a></li>
            </ul>
        </nav>
    </header>

    <?php if ($destination): ?>
        <section class="destination-header">
            <h1><?php echo htmlspecialchars($destination['pname']); ?></h1>
        </section>

        <section class="destination-content">
            <div class="main-image-container">
                <img src="<?php echo htmlspecialchars($destination['pi_main']); ?>" alt="<?php echo htmlspecialchars($destination['pname']); ?> Main Image">
            </div>
            <div class="details-text">
                <h2>About This Destination</h2>
                <p><?php echo nl2br(htmlspecialchars($destination['pdescription'])); ?></p>
                <div class="package-info">
                    Package Price: ₹<?php echo htmlspecialchars($destination['package']); ?>
                </div>
                <a href="booking.php?dest=<?php echo urlencode($destination['pname']); ?>" class="book-now-btn">Book Now</a>

                <div class="thumbnail-gallery">
                    <?php if (!empty($destination['pi1'])): ?>
                        <img src="<?php echo htmlspecialchars($destination['pi1']); ?>" alt="<?php echo htmlspecialchars($destination['pname']); ?> Image 1">
                    <?php endif; ?>
                    <?php if (!empty($destination['pi2'])): ?>
                        <img src="<?php echo htmlspecialchars($destination['pi2']); ?>" alt="<?php echo htmlspecialchars($destination['pname']); ?> Image 2">
                    <?php endif; ?>
                    <?php if (!empty($destination['pi3'])): ?>
                        <img src="<?php echo htmlspecialchars($destination['pi3']); ?>" alt="<?php echo htmlspecialchars($destination['pname']); ?> Image 3">
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php else: ?>
        <div class="error-message">
            <p><?php echo $error_message ?? "The requested destination could not be found."; ?></p>
            <p><a href="destinations.php" class="btn-primary">Back to Destinations</a></p>
        </div>
    <?php endif; ?>

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
        // Placeholder for live chat
        function openChat() {
            alert('Opening live chat... (Integration with a chat service will go here)');
        }
        // Basic image gallery functionality (optional, can be enhanced with lightbox)
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.querySelector('.main-image-container img');
            const thumbnails = document.querySelectorAll('.thumbnail-gallery img');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    mainImage.src = this.src;
                    mainImage.alt = this.alt;
                });
            });
        });
    </script>
</body>
</html>
<?php
mysqli_close($conn); // Close the database connection
?>