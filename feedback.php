<?php
// Database connection
$con = mysqli_connect('localhost:3306','root','','travel'); // Ensure this is 3306

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Only process if the form has been submitted (assuming your submit button is named 'submit')
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedbk']; // Corrected variable name to avoid conflict with 'feedback' function

    // Prepare and execute SQL query
    // NOTE: Using prepared statements with mysqli_stmt_bind_param is highly recommended for security.
    // For now, we'll use string concatenation, but be aware of SQL injection risks.
    $sql = "INSERT INTO `feedback`(`id`,`name`,`email`,`feedbk`) VALUES (0,'$name','$email','$feedback')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        // Data inserted successfully
        // Redirect back to the feedback form with a success message indicator
        header('location:feedback.html?status=feedback_submitted');
        exit(); // Always exit after a header redirect
    } else {
        // Error inserting data
        echo "Error: " . mysqli_error($con);
        // You might want to redirect to an error page or back to the form with an error message
        // header('location:feedback.html?status=error');
        // exit();
    }
} else {
    // If feedback.php is accessed directly without form submission, redirect to feedback.html
    header('location:feedback.html'); // Redirects to the feedback form
    exit(); // Important: Stop script execution after redirect
}

// Close the database connection (only if script hasn't exited)
if (isset($con) && $con) {
    mysqli_close($con);
}
?>