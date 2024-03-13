
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

        // Check if the product ID is received via GET
        if (isset($_GET['id'])) {
            // Retrieve product ID
            $productId = $_GET['id'];
            
            // Check if the product already exists in the cart for the current user
            $existingCartItemSql = "SELECT * FROM tbl_cart WHERE user_id = '$userId' AND product_id = '$productId'";
            $existingCartItemResult = mysqli_query($conn, $existingCartItemSql);

            if (mysqli_num_rows($existingCartItemResult) > 0) {
                // If the product already exists in the cart, update the quantity
                $existingCartItem = mysqli_fetch_assoc($existingCartItemResult);
                $qty = $existingCartItem['qty'] + 1; // Increment the quantity by 1
                $total = $existingCartItem['price'] * $qty; // Calculate the new total

                // Update the quantity and total in the cart table
                $updateCartItemSql = "UPDATE tbl_cart SET qty = '$qty', total = '$total' WHERE user_id = '$userId' AND product_id = '$productId'";
                $updateCartItemResult = mysqli_query($conn, $updateCartItemSql);

                if ($updateCartItemResult) {
                    // Quantity updated successfully
                    //echo "Quantity updated successfully.";
                    header('location:'. 'shop.php');
                } else {
                    // Failed to update quantity
                    echo "Failed to update quantity. Please try again.";
                }
            } else {
                // If the product does not exist in the cart, insert a new record
                // Query to fetch product information based on product ID
                $sql2 = "SELECT * FROM tbl_product WHERE id='$productId'";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 && mysqli_num_rows($res2) > 0) {
                    // Fetch product details
                    $row2 = mysqli_fetch_assoc($res2);
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];
                    $qty = 1; // Assuming the quantity is fixed to 1 for now
                    $total = $price * $qty; // Calculate total price
                    $category_id = $row2['category_id'];
                    
                    // Get current date and time for created_at
                    $created_at = date('Y-m-d H:i:s');
                    
                    // Query to insert the item into the cart
                    $insertCartItemSql = "INSERT INTO tbl_cart (user_id, product_id, title, price, qty, total, category_id, created_at) VALUES ('$userId', '$productId','$title','$price','$qty','$total','$category_id','$created_at')";
                    $insertCartItemResult = mysqli_query($conn, $insertCartItemSql);

                    if ($insertCartItemResult) {
                        // Item added to cart successfully
                        echo "Item added to cart successfully.";
                    } else {
                        // Failed to add item to cart
                        echo "Failed to add item to cart. Please try again.";
                    }
                } else {
                    // If the product information is not found, return an error message
                    echo "Error: Product information not found.";
                }
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
    // If the user is not logged in, redirect them to the login page
    header('location: user-login.php');
    exit(); // Stop further execution
}
?>
