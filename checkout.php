<?php ob_start(); ?>

<?php include('partials-front/navbar.php')?>

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

<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">Billing Details</h2>
                <div class="p-3 p-lg-5 border bg-white">
                    <form method="post" action="">
                        <?php
                        if(isset($_SESSION['user'])) {
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
                            header('location: user-login.php');
                            exit(); // Stop further execution
                        }
                        ?>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_fname" name="c_fname" value="<?php echo $first_name;?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_lname" name="c_lname" value="<?php echo $last_name;?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_state_country" class="text-black">State <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_state" name="c_state" required>
                            </div>
                            <div class="col-md-6">
                                <label for="c_postal_zip" class="text-black">Postal / Zip <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip" required>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="c_email_address" name="c_email_address" value="<?php echo $email;?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" value="<?php echo $phone_no;?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Order Notes</label>
                            <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                        </div>

                </div>
            </div>
            <div class="col-md-6">

                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                        <div class="p-3 p-lg-5 border bg-white">

                            <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                            <div class="input-group w-75 couponcode-wrap">
                                <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2" name="coupon_code">
                                <div class="input-group-append">
                                    <button class="btn btn-black btn-sm" type="button" id="button-addon2">Apply</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

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
                        $cartItemsSql = "SELECT * FROM tbl_cart WHERE user_id = '$userId'";
                        $cartItemsResult = mysqli_query($conn, $cartItemsSql);
                        $subtotal = 0;
                        
                        if(mysqli_num_rows($cartItemsResult) > 0) {
                            while($cartItem = mysqli_fetch_assoc($cartItemsResult)) {
                                $title = $cartItem['title'];
                                $qty = $cartItem['qty'];
                                $total = $cartItem['total'];
                                $subtotal += $total;
                    ?>
                    <tr>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td>RM <?php echo $total; ?></td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                    <tr>
                        <td class="text-black font-weight-bold" colspan="2"><strong>Cart Subtotal</strong></td>
                        <td class="text-black"><?php echo "RM " . $subtotal; ?></td>
                    </tr>
                    <tr>
                        <td class="text-black font-weight-bold" colspan="2"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>RM <?php echo $subtotal; ?></strong></td>
                    </tr>
                </tbody>
            </table>

                <!-- Direct Bank Transfer -->
                <div class="border p-3 mb-3">
                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                    <div class="collapse" id="collapsebank">
                        <div class="py-2">
                            <div class="mb-3">
                                <label for="bankNumber" class="form-label">Bank Number</label>
                                <input type="text" class="form-control" id="bankNumber" name="bankNumber" required>
                            </div>
                            <div class="mb-3">
                                <label for="bankImage" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" id="bankImage" name="bankImage" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-black btn-lg py-3 btn-block" name="submit">Place Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<?php
if (isset($_POST["submit"])) {
    // Get all the details from the form
    $first_name = $_POST["c_fname"];
    $last_name = $_POST['c_lname'];
    $address = $_POST['c_address'];
    $state = $_POST['c_state'];
    $postal_zip = $_POST['c_postal_zip'];
    $email = $_POST['c_email_address'];
    $phone = $_POST['c_phone'];
    $order_notes = $_POST['c_order_notes'];
    $coupon = $_POST['coupon_code'];
    $bank_number = $_POST['bankNumber'];
    $bank_image_name = $_FILES['bankImage']['name']; // Get the file name
    $order_date = date('Y-m-d H:i:s'); // Use current date and time
    $status = "Received";

    // Save the Order in Database
    $sql = "INSERT INTO tbl_order 
    (first_name, last_name, address, state, postal_zip, email, phone, order_notes, coupon, bank_number, bank_image_name, order_date, status) 
    VALUES 
    ('$first_name', '$last_name', '$address', '$state', '$postal_zip', '$email', '$phone', '$order_notes', '$coupon', '$bank_number', '$bank_image_name', '$order_date', '$status')";

    // Execute the SQL query
    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Move uploaded bank image to destination folder
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["bankImage"]["name"]);

        // Check if file already exists
        if (file_exists($target_file)) {
            // Handle file name conflict
            $bank_image_name = uniqid() . '_' . $_FILES["bankImage"]["name"];
        }

        // Move the file to the specified directory
        move_uploaded_file($_FILES["bankImage"]["tmp_name"], $target_dir . $bank_image_name);

        // Clear the cart
        unset($_SESSION['cart']);

        // Redirect to thankyou.php
        $_SESSION['success_message'] = "Order placed successfully!";
        header('location: thankyou.php');
        exit();
    } else {
        // Error occurred while inserting the order
        $_SESSION['error_message'] = "Failed to place order. Please try again later.";
        header('location: checkout.php');
        exit();
    }
}
?>

<?php include('partials-front/footer.php')?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Handle Place Order button click
    $('#placeOrderBtn').click(function(){
        // Submit bank transfer form
        $('#bankTransferForm').submit();
    });

    // Handle bank transfer form submission
    $('#bankTransferForm').submit(function(e){
        e.preventDefault();
        // Handle form submission here
        // You can use AJAX to submit the form data
        
        // After successful submission, remove cart items
        $.ajax({
            url: 'remove-cart-item.php', // URL to remove cart items
            type: 'POST',
            success: function(response) {
                // Redirect to thankyou.php
                window.location.href = 'thankyou.php';
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
<?php ob_end_flush(); ?>
