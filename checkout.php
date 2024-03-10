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
										echo "Quantity updated successfully.";
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
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_fname" name="c_fname" value="<?php echo $first_name;?>">
                        </div>
                        <div class="col-md-6">
                            <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_lname" name="c_lname" value="<?php echo $last_name;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_state_country" name="c_state_country">
                        </div>
                        <div class="col-md-6">
                            <label for="c_postal_zip" class="text-black">Postal / Zip <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                        </div>
                    </div>

                    <div class="form-group row mb-5">
                        <div class="col-md-6">
                            <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_email_address" name="c_email_address" value="<?php echo $email;?>">
                        </div>
                        <div class="col-md-6">
                            <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" value="<?php echo $phone_no;?>">
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
                                <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
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
                            <form id="bankTransferForm">
                                <div class="mb-3">
                                    <label for="bankNumber" class="form-label">Bank Number</label>
                                    <input type="text" class="form-control" id="bankNumber" name="bankNumber">
                                </div>
                                <div class="mb-3">
                                    <label for="bankImage" class="form-label">Upload Image</label>
                                    <input type="file" class="form-control" id="bankImage" name="bankImage">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                            <div class="form-group">
                                <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='thankyou.php'">Place Order</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- </form> -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


<?php include('partials-front/footer.php')?>
