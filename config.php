<?php
// Database connection parameters
// Using 'localhost' and port '3306' as per your XAMPP setup
// Username 'root' and empty password are XAMPP defaults
$dbHost = 'localhost:3306';
$dbUser = 'root';
$dbPass = ''; // XAMPP default is typically an empty string
$dbName = 'travel'; // Your database name
// Establish database connection
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Define Admin Contact Details
// As clarified, Dinesh S is admin, email 'contact@yourdomain.com' for now, phone 9025650323
$adminName = "Dinesh S";
$adminEmail = "contact@yourdomain.com"; // Placeholder, update with actual domain email later
$adminPhone = "9025650323";

// Set default timezone for PHP (optional but good practice)
date_default_timezone_set('Asia/Kolkata'); // Setting to Chennai's timezone (IST)

// You can add other global configurations here if needed

// --- Security Enhancements (will be applied in subsequent code snippets) ---
// This config file does not directly implement prepared statements or validation,
// but it ensures the connection is ready for secure queries in other files.

?>