<?php
include("config/constants.php");

if(isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];

    // Retrieve the current quantity and price from the database
    $sql = "SELECT qty, price FROM tbl_cart WHERE id = '$cartId'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentQty = $row['qty'];
        $price = $row['price'];

        // Increment the quantity
        $newQty = $currentQty + 1;
        $newAmount = $newQty * $price;

        // Update the quantity and total amount in the database
        $updateSql = "UPDATE tbl_cart SET qty = '$newQty', total = '$newAmount' WHERE id = '$cartId'";
        $updateResult = mysqli_query($conn, $updateSql);

        if($updateResult) {
            echo $newQty; // Return the new quantity
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
