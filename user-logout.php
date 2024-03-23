<?php
    include("config/constants.php");

    // Start or resume session
    session_start();

    // Destroy the session
    session_unset();
    session_destroy();

    // Redirect to login page or any other desired page
    header('location:'.SITEURL.'user-login.php');
?>
