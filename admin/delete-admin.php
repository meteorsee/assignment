<?php

    // Include constanst.php 
    include ("../config/constants.php");

    // GET the ID from Admin to delete
    $id = $_GET["id"];

    // Create SQL Query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res == true){
        // Query executed successfully and Admin deleted
        //echo "Admin Deleted";

        // Create Session Variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        
        // Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }else{
        // Failed to delete admin
        //echo "Failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //Redirect to manage admin page with message (success/error)

?>