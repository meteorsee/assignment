<?php
// Start the session
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // Set the time when the session started
    $sessionStartTime = $_SESSION['session_start_time'];

    // Set the duration of the session (in seconds)
    $sessionDuration = 100; // 30 minutes (you can adjust this value as needed)

    // Check if the session duration has passed
    if(time() - $sessionStartTime > $sessionDuration) {
        // Session duration has passed, destroy the session
        session_unset();
        session_destroy();
        // Redirect the user to the login page or any other desired page
        header("Location: login.php");
        exit();
    } else {
        // Session duration has not passed, redirect the user to the home page or any other desired page
        header("Location: index.php");
        exit();
    }
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit();
}
?>
