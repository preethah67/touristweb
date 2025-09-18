<?php
include_once 'config.php'; // Include the database connection

// Initialize search query
$search_query = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    // Basic search functionality for now, will be enhanced later with prepared statements
    $search_term = mysqli_real_escape_string($conn, $_GET['search']);
    $search_query = " WHERE `pname` LIKE '%$search_term%' OR `pdescription` LIKE '%$search_term%'";
}

// Fetch destinations from the database
// Using a simple query for now. Will be converted to prepared statements for security.
$sql = "SELECT * FROM `information`" . $search_query;
$result = mysqli_query($conn, $sql);

// Check if query was successful
if (!$result) {
    die("Error fetching destinations: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Destinations - Travel Explorer</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Specific styles for the destinations page */
        .destinations-hero {
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/India_Gate_Night_View.jpg/1920px-India_Gate_Night_View.jpg') no-repeat center center/cover; /* Placeholder, customize */
            color: #fff;
            text-align: center;
            padding: 80px 20px;
            position: relative;
        }
        .destinations-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4); /* Dark overlay */
            z-index: 1;
        }
        .destinations-hero h1 {
            color: #fff;
            font-size: 3.5em;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.7);
        }
        .destinations-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .destination-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            text-align: left;
            transition: transform 0.3s ease;
        }
        .destination-card:hover {
            transform: translateY(-5px);
        }
        .destination-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }
        .card-content {
            padding: 20px;
        }
        .card-content h3 {
            color: var(--primary-blue);
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.8em;
        }
        .card-content p {
            font-size: 0.95em;
            color: #555;
            margin-bottom: 15px;
            height: 70px; /* Limit height for consistent card size */
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .card-content .package-price {
            font-size: 1.2em;
            color: var(--accent-orange);
            font-weight: bold;
            margin-bottom: 15px;
        }
        .card-content .btn-primary {
            display: inline-block;
            width: 100%;
            text-align: center;
            padding: 10px 0;
        }
        .no-results {
            text-align: center;
            padding: 50px;
            font-size: 1.2em;
            color: #666;
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

    <section class="destinations-hero">
        <h1>Explore Our Destinations</h1>
        <div class="search-bar" style="position: relative; z-index: 2; margin-top: 30px;">
            <form method="GET" action="destinations.php" style="display: flex; gap: 10px; width: 100%; max-width: 600px;">
                <input type="text" name="search" placeholder="Search destinations..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                <button type="submit">Search</button>
            </form>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">All Travel Packages</h2>
        <div class="destinations-container">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    // Display each destination as a card
            ?>
                    <div class="destination-card">
                        <img src="<?php echo htmlspecialchars($row['pi_main']); ?>" alt="<?php echo htmlspecialchars($row['pname']); ?> Main Image">
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($row['pname']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($row['pdescription'], 0, 150)) . '...'; ?></p> <div class="package-price">Package: ₹<?php echo htmlspecialchars($row['package']); ?></div>
                            <a href="destination_detail.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn-primary">View Details</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="no-results">No destinations found. Please add some from the Admin Panel!</p>';
            }
            ?>
        </div>
    </section>

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
        // Placeholder for live chat (will integrate actual chat widget later)
        function openChat() {
            alert('Opening live chat... (Integration with a chat service will go here)');
            // Here you would typically initialize a third-party chat widget
        }
    </script>
</body>
</html>
<?php
mysqli_close($conn); // Close the database connection
?>