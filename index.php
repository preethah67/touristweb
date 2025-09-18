<?php
include_once 'config.php'; // Include the database connection and global configs

// You can add PHP logic here later to fetch dynamic content
// For now, this is a basic structure.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Explorer - Your Journey Starts Here</title>
    <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <header class="main-header">
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">Travel Explorer</a> </div>
            <ul class="nav-list">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="destinations.php">Destinations</a></li> <li><a href="gallery.php">Gallery</a></li>
                <li><a href="booking.php">Bookings</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="login.php">Login/Register</a></li> <li><a href="admin.php">Admin Panel</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero-section">
        <div class="hero-content">
            <h1>Discover India's Wonders</h1>
            <p>Your ultimate guide to incredible journeys across India, from vibrant cities to serene landscapes. Explore Tamil Nadu's rich culture!</p>
            <a href="destinations.php" class="btn-primary">Explore Destinations</a>
            <div class="search-bar">
                <input type="text" placeholder="Search destinations, cities, packages..." id="mainSearchBar">
                <button onclick="performSearch()">Search</button>
            </div>
        </div>
    </section>

    <section class="section about-us-section">
        <h2 class="section-title">About Travel Explorer</h2>
        <p>We are passionate about bringing the diverse beauty and rich heritage of India closer to you. Our expertly curated tours ensure an unforgettable travel experience, designed for every kind of adventurer. Discover hidden gems, bustling markets, tranquil beaches, and majestic mountains with us. We specialize in bespoke tours across various states, with a special focus on the vibrant culture and breathtaking landscapes of Tamil Nadu.</p>
        <p>With years of experience, we pride ourselves on providing seamless and memorable travel experiences. Our team is dedicated to offering personalized service, ensuring your journey is not just a trip, but a collection of cherished memories.</p>
    </section>

    <section class="section featured-destinations-section">
        <h2 class="section-title">Featured Destinations</h2>
        <div class="destination-grid">
            <div class="destination-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/cb/Meenakshi_Amman_Temple_Madurai.jpg" alt="Madurai Temple">
                <h3>Madurai, Tamil Nadu</h3>
                <p>Explore the ancient city of Madurai, home to the iconic Meenakshi Amman Temple.</p>
                <a href="destination_detail.php?id=1" class="btn-primary">View Details</a>
            </div>
            <div class="destination-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1d/Mahabalipuram-Seven_Ratha.jpg/800px-Mahabalipuram-Seven_Ratha.jpg" alt="Mahabalipuram">
                <h3>Mahabalipuram, Tamil Nadu</h3>
                <p>Discover UNESCO World Heritage sites and ancient rock-cut temples on the coast.</p>
                <a href="destination_detail.php?id=2" class="btn-primary">View Details</a>
            </div>
            <div class="destination-card">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Pangong_Tso_Lake_Leh_Ladakh_India.jpg/800px-Pangong_Tso_Lake_Leh_Ladakh_India.jpg" alt="Leh Ladakh">
                <h3>Leh Ladakh, India</h3>
                <p>Experience the mesmerizing landscapes and spiritual tranquility of the Himalayas.</p>
                <a href="destination_detail.php?id=3" class="btn-primary">View Details</a>
            </div>
        </div>
        <a href="destinations.php" class="btn-primary" style="margin-top: 40px;">View All Destinations</a>
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
        // Placeholder for dynamic search (will be improved later)
        function performSearch() {
            const searchTerm = document.getElementById('mainSearchBar').value;
            if (searchTerm) {
                alert('Searching for: ' + searchTerm);
                // In a real application, this would redirect or fetch results dynamically
                window.location.href = 'destinations.php?search=' + encodeURIComponent(searchTerm);
            }
        }

        // Placeholder for live chat (will integrate actual chat widget later)
        function openChat() {
            alert('Opening live chat... (Integration with a chat service will go here)');
            // Here you would typically initialize a third-party chat widget
            // e.g., Tawk.to, Freshchat, or a custom basic chat
        }
    </script>
</body>
</html>