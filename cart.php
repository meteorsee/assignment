<?php include('partials-front/navbar.php')?>

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Cart</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section before-footer-section">
            <div class="container">
            <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($_SESSION['user'])) {
                                // Retrieve the user ID from the session
                                $username = $_SESSION['user'];
                                $sql = "SELECT id FROM tbl_user WHERE username = '$username'";
                                $res = mysqli_query($conn, $sql);

                                if ($res && mysqli_num_rows($res) > 0) {
                                    $row = mysqli_fetch_assoc($res);
                                    $userId = $row['id'];

                                    // Query to fetch items from cart for the user
                                    $sql_cart = "SELECT * FROM tbl_cart WHERE user_id = '$userId'";
                                    $res_cart = mysqli_query($conn, $sql_cart);

                                    if ($res_cart && mysqli_num_rows($res_cart) > 0) {
                                        while ($row_cart = mysqli_fetch_assoc($res_cart)) {
                                            // Fetch product details
                                            $productId = $row_cart['product_id'];
                                            $qty = $row_cart['qty'];
                                            
                                            // Query to fetch product details based on product ID
                                            $sql_product = "SELECT * FROM tbl_product WHERE id = '$productId'";
                                            $res_product = mysqli_query($conn, $sql_product);

                                            if ($res_product && mysqli_num_rows($res_product) > 0) {
                                                $row_product = mysqli_fetch_assoc($res_product);
                                                $title = $row_product['title'];
                                                $price = $row_product['price'];
                                                $image_name = $row_product['image_name'];
                                                $total = $price * $qty;
                                                $category_id = $row_product['category_id'];
                                            ?>
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <?php if($image_name != ""): ?>
                                                            <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" width="100px">
                                                        <?php else: ?>
                                                            <div class='error'>No Image Available.</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="product-name">
                                                        <h2 class="h5 text-black"><?php echo $title; ?></h2>
                                                    </td>
                                                    <td><?php echo $price; ?></td>
                                                    <td>
                                                        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                                            <input type="text" class="form-control text-center quantity-amount" value="<?php echo $qty; ?>" readonly>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $total; ?></td>
                                                    <td><a href="delete-from-cart.php?id=<?php echo $productId; ?>" class="btn btn-black btn-sm">Remove</a></td>
                                                </tr>
                                            <?php
                                            } else {
                                                echo "<tr><td colspan='6'>Product details not found.</td></tr>";
                                            }
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No items in the cart.</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>User information not found.</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <label class="text-black h4" for="coupon">Coupon</label>
                      <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                      <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                      <button class="btn btn-black">Apply Coupon</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <span class="text-black">Subtotal</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">$230.00</strong>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">$230.00</strong>
                        </div>
                      </div>
        
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		
		  <?php include('partials-front/footer.php')?>
