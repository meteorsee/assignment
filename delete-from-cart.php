<?php include("config/constants.php"); ?>
<?php
    // Check if the product ID is set in the URL parameters
    if(isset($_GET["id"])){
        // Get the product ID from the URL
        $productId = $_GET["id"];

        // Delete the product from the cart table
        $sql = "DELETE FROM tbl_cart WHERE product_id=$productId";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check if the query was successful
        if($res == true){
            // Set success message and redirect to cart page
            $_SESSION["success"] = "Product removed from cart successfully.";
            header("location:".SITEURL."cart.php");
        }else{
            // Set error message and redirect to cart page
            $_SESSION["error"] = "Failed to remove product from cart.";
            header("location:".SITEURL."cart.php");
        }
    }else{
        // Redirect to cart page if product ID is not set
        header("location:".SITEURL."cart.php");
    }
?>
