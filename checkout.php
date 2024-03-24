<?php 
include('partials-front/navbar.php'); 

function generateInvoiceNumber() {
    // Set the default time zone to Malaysia
    date_default_timezone_set('Asia/Kuala_Lumpur');
    
    // Generate a unique invoice number based on your criteria
    // For example, you can combine a prefix with a formatted timestamp
    $prefix = "INV";
    $timestamp = time();
    $formattedTimestamp = date('YmdHis', $timestamp); // Format timestamp as YYYYMMDDHHmmss
    $invoiceNumber = $prefix . $formattedTimestamp;
    
    return $invoiceNumber;
}


?>

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Checkout</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->
<?php
if (isset($_SESSION['user'])) {
    // Retrieve the username from the session
    $username = $_SESSION['user'];

    // Query to fetch the user information based on the username
    $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        // Fetch user details
        $row = mysqli_fetch_assoc($res);
        $userId = $row['id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $phone_no = $row['phone_no'];
    } else {
        // If the user information is not found in the database, handle the error
        echo "Error: User information not found.";
    }
} else {
    // If the user is not logged in, redirect them to the login page
    //header('location: user-login.php');
    echo "<script type='text/javascript'>window.location.href = 'user-login.php';</script>";
    exit(); // Stop further execution
}

//     if (isset($_SESSION['order-success'])) {
//         echo $_SESSION['order-success'];
//         unset($_SESSION['order-success']);
//     }
// if (isset($_SESSION['order-failed'])) {
//     echo $_SESSION['order-failed'];
//     unset($_SESSION['order-failed']);
// }
?>
<div class="untree_co-section">
    <div class="container">
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border bg-white">



                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">First Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_fname" name="c_fname"
                                    value="<?php echo $first_name; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Last Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_lname" name="c_lname"
                                    value="<?php echo $last_name; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_address" name="c_address"
                                    placeholder="Street address" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_state_country" class="text-black">State <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_state_country" name="c_state" required>
                            </div>
                            <div class="col-md-6">
                                <label for="c_postal_zip" class="text-black">Postal / Zip <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip" required>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="c_email_address" class="text-black">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_email_address" name="c_email"
                                    value="<?php echo $email; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_phone" name="c_phone"
                                    placeholder="Phone Number" value="<?php echo $phone_no; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Order Notes</label>
                            <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                                placeholder="Write your notes here..."></textarea>
                        </div>

                    </div>
                    <br>
                    <!--
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                        <div class="p-3 p-lg-5 border bg-white">

                            <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                            <div class="input-group w-75 couponcode-wrap">
                                <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code"
                                    aria-label="Coupon Code" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-black btn-sm" type="button" id="button-addon2">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
-->
                </div>
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query to fetch all products in the cart for the current user
                                        $sql2 = "SELECT * FROM tbl_cart WHERE user_id = '$userId'";
                                        $res2 = mysqli_query($conn, $sql2);
                                        $subtotal = 0;

                                        if (mysqli_num_rows($res2) > 0) {
                                            while ($cartItem = mysqli_fetch_assoc($res2)) {
                                                $title = $cartItem['title'];
                                                $qty = $cartItem['qty'];
                                                $total = $cartItem['total'];
                                                $subtotal += $total;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $title; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $qty; ?>
                                                    </td>
                                                    <td>RM
                                                        <?php echo $total; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td class="text-black font-weight-bold" colspan="2"><strong>Cart
                                                    Subtotal</strong></td>
                                            <td class="text-black">
                                                <?php echo "RM " . $subtotal; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold" colspan="2"><strong>Order
                                                    Total</strong>
                                            </td>
                                            <td class="text-black font-weight-bold"><strong>RM
                                                    <?php echo $subtotal; ?>
                                                </strong></td>
                                        </tr>
                                    </tbody>
                                </table>



                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $userId; ?>">
                                    <input type="submit" name="submit" value="Place Order"
                                        class="btn btn-black btn-lg py-3 btn-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php

if (isset($_POST["submit"])) {
    // Get all the user details from the form
    $first_name = $_POST["c_fname"];
    $last_name = $_POST['c_lname'];
    $address = $_POST['c_address'];
    $state = $_POST['c_state'];
    $postal = $_POST['c_postal_zip'];
    $email = $_POST["c_email"];
    $phone_no = $_POST["c_phone"];
    $order_notes = $_POST["c_order_notes"];
    $order_date = date('Y-m-d h:i:sa');
    $status = "Proceed to Payment";
    $user_id = $_POST['id'];

    // Generate an invoice number
    $invoiceNumber = generateInvoiceNumber();
    
    // Query to fetch all products in the cart for the current user
    $sql_cart = "SELECT * FROM tbl_cart WHERE user_id = '$user_id'";
    $res_cart = mysqli_query($conn, $sql_cart);

    if ($res_cart && mysqli_num_rows($res_cart) > 0) {
        while ($cartItem = mysqli_fetch_assoc($res_cart)) {
            $product_id = $cartItem['product_id'];
            $product_title = $cartItem['title'];
            $product_price = $cartItem['price'];
            $product_qty = $cartItem['qty'];
            $product_total = $cartItem['total'];

            // Insert product details into the tbl_order table
            $sql_insert = "INSERT INTO tbl_order (invoice_number, first_name, last_name, address, state, postal, email, phone_no, order_notes, order_date, status, user_id, product_id, product_title, product_price, product_qty, product_total) 
                            VALUES ('$invoiceNumber', '$first_name', '$last_name', '$address', '$state', '$postal', '$email', '$phone_no', '$order_notes', '$order_date', '$status', '$user_id', '$product_id', '$product_title', '$product_price', '$product_qty', '$product_total')";
            $res_insert = mysqli_query($conn, $sql_insert);

            if (!$res_insert) {
                $_SESSION['order-failed'] =  "<div class='success'>Failed to place order.</div>";
                echo "<script type='text/javascript'>window.location.href = 'checkout.php';</script>";
                exit(); // Stop further execution
            }
        }

        // // After inserting all products, clear the cart (optional)
        // $sql_clear_cart = "DELETE FROM tbl_cart WHERE user_id = '$user_id'";
        // mysqli_query($conn, $sql_clear_cart);

        //$_SESSION['order-success'] =  "<div class='success'>Order Placed Successfully.</div>";
        $_SESSION ['invoice'] = $invoiceNumber;
        echo "<script type='text/javascript'>window.location.href = 'payment.php';</script>";
        exit(); // Stop further execution
    } else {
        $_SESSION['order-failed'] =  "<div class='success'>Failed to place order. Cart is empty.</div>";
        echo "<script type='text/javascript'>window.location.href = 'checkout.php';</script>";
        exit(); // Stop further execution
    }
}    

?>

<?php include('partials-front/footer.php') ?>