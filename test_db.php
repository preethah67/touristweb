<?php
include_once 'config.php';

if ($conn) {
    echo "<h1>Database connection successful!</h1>";
    mysqli_close($conn);
} else {
    echo "<h1>Database connection failed!</h1>";
    echo "<p>Error: " . mysqli_connect_error() . "</p>";
}
?>