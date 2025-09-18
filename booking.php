<?php
// Database connection
$con = mysqli_connect('localhost:3306','root','','travel'); // Ensure this is 3306

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Only process if the form has been submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $firstname = $_POST['ffirst'];
    $lastname = $_POST['flast'];
    $email = $_POST['femail'];
    $city = $_POST['city'];
    $phone = $_POST['fphone'];
    $destination = $_POST['fdesti'];

    // Prepare and execute SQL query
    $sql = "INSERT INTO `booking`(`id`,`ffirst`,`flast`,`femail`,`city`,`fphone`,`fdesti`) VALUES (0,'$firstname','$lastname','$email','$city','$phone','$destination')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        // Data inserted successfully
        header('location:booking_success.html'); // Redirect to the new success page
        exit(); // Always exit after a header redirect
    } else {
        // Error inserting data
        echo "Error: " . mysqli_error($con);
        // You might want to redirect to an error page or back to the form with an error message
        // header('location:booking.html?error=db_error');
        // exit();
    }
} else {
    // If booking.php is accessed directly without form submission, redirect to booking.html
    header('location:booking.html'); // Redirects to the booking form
    exit(); // Important: Stop script execution after redirect
}

// Close the database connection (only if script hasn't exited)
// This line will only be reached if there was a database error that didn't redirect.
if (isset($con) && $con) {
    mysqli_close($con);
}
?>