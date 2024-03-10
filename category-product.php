<?php include("partials-front/navbar.php"); ?>

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
        <?php
        // Check whether the id is passed or not
        if (isset($_GET["category_id"])) {
            // Category id is set
            $category_id = $_GET["category_id"];

            // Get the category title based on the category id
            $sql = "SELECT title FROM tbl_category WHERE id='$category_id'";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Get the value from database
            $row = mysqli_fetch_assoc($res);

            // Get the title
            $category_title = $row['title'];
        } else {
            // Category id is not available
            // Redirect to home page
            header("location:" . SITEURL);
        }

        ?>
        <h2>Product on Your Search <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</div>
<!-- End Hero Section -->

<!-- Product Menu Section Starts Here -->
<section class="product-menu">
    <div class="container">
        <?php
        // SQl Query to get food based on search keyword
        $sql2 = "SELECT  * FROM tbl_product WHERE category_id='$category_id'";

        // Execute the query
        $res2 = mysqli_query($conn, $sql2);

        // Count Rows
        $count2 = mysqli_num_rows($res2);

        // Check whether product available or not
        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                // Get the details
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
        ?>
                <div class="product-menu-box">
                    <div class="product-menu-img">
                        <?php
                        if ($image_name == "") {
                            // Display message
                            echo "<div class='error'>Image Not Available.</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" class="img-fluid product-thumbnail">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="product-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">RM<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>
                        <a class="btn btn-primary" href="<?php echo SITEURL; ?>add-to-cart.php?id=<?php echo $id; ?>" class="add-to-cart-link"> Add to cart </a>
                    </div>
                </div>
        <?php
            }
        } else {
            // Food not found
            echo "<div class='error'>Product Not Found.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Product Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior
                var productId = button.getAttribute('data-product-id');
                addToCart(productId);
            });
        });

        function addToCart(productId) {
            // Send AJAX request to add the item to the cart
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'add-to-cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response, e.g., update cart icon or display a success message
                    console.log(xhr.responseText);
                }
            };
            xhr.send('id=' + encodeURIComponent(productId));
        }
    });
</script>
