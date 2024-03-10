<?php
// Include database connection code
include('config/constants.php');

// Check if the user is logged in
if(isset($_SESSION['user'])) {
    // Retrieve the username from the session
    $username = $_SESSION['user'];
    
    // Query to fetch the user information based on the username
    $sql = "SELECT id FROM tbl_user WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        // Fetch user ID from the database result
        $row = mysqli_fetch_assoc($res);
        $userId = $row['id'];

        // Check if the product ID is received via POST
        if (isset($_POST['product_id'])) {
            // Retrieve product ID
            $productId = $_POST['product_id'];
            
            // Query to delete the cart item
            $deleteCartItemSql = "DELETE FROM tbl_cart WHERE user_id = '$userId' AND product_id = '$productId'";
            $deleteCartItemResult = mysqli_query($conn, $deleteCartItemSql);

            if ($deleteCartItemResult) {
                // Cart item deleted successfully
                echo "Cart item removed successfully.";
            } else {
                // Failed to delete cart item
                echo "Failed to remove cart item. Please try again.";
            }
        } else {
            // If the product ID is not received, return an error message
            echo "Error: Product ID not received.";
        }
    } else {
        // If the user information is not found in the database, handle the error
        echo "Error: User information not found.";
    }
} else {
    // If the user is not logged in, return an error message
    echo "Error: User not logged in.";
}
?>
