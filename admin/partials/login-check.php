<?php
    
    // Authorization -- Access Control
    // Check whether the user is logged in or not
    if(!isset($_SESSION['user'])){  // If the user session is not set
        // User is not login
        // Redirect to login page with message

        $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to access Admin Panel.</div>";

        header("location:".SITEURL."admin/login.php");
    }
    
?>