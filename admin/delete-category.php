<?php include ("../config/constants.php");?>
<?php
    // Check whether teh id and image_name is set or not
    if(isset($_GET["id"]) AND  isset($_GET["image_name"])){
        // Get the value and Delete it
        $id = $_GET["id"];
        $image_name = $_GET["image_name"];

        // Remove the physical file if it is available
        if($image_name != ""){

            // Image is available. So remove it
            $path = "../images/category/".$image_name;

            // Remove the image
            $remove = unlink($path);

            // If failed to remove image then add an error message and stop the process
            if($remove == false){
                // Set the session message
                $_SESSION["remove"] = "<div class='error'>Failed to Remove Category Image.</div>";
                // Redirect to Manage Category page
                header("location:".SITEURL."admin/manage-category.php");
                // Stop the process
                die();                
            }
        }
        // Delete the data from database
        // SQL Query to delete the data from the database 
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the data is deleted from the database
        if($res==true){
            // Set success message and redirect
            // Set the session message
            $_SESSION["delete"] = "<div class='success'>Category Deleted Successfully.</div>";
            // Redirect to Manage Category page
            header("location:".SITEURL."admin/manage-category.php");
        }else{
            // Set failed message and redirect
            // Set the session message
            $_SESSION["delete"] = "<div class='error'>Failed to Delete Category.</div>";
            // Redirect to Manage Category page
            header("location:".SITEURL."admin/manage-category.php");
        }

        // Redirect to Manage Category page with message
    }else{
        
        // Redirect to the Manage Category page
        header("location:".SITEURL."admin/manage-category.php");
    }
?>

