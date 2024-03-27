<?php 
    include("../config/constants.php");
    include("login-check.php");
    include('auth.php'); 

?>

<html>
    <head>
        <title>Phone Accessories Order Website - Home Page</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="../favicon.png">
        <meta http-equiv="refresh" content="60">
    </head>
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-product.php">Product</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="manage-contact.php">Contact</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->