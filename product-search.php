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
        // Get the search keyword
        //$search = $_POST['search'];
        $search = mysqli_real_escape_string($conn, $_POST["search"]);
        ?>
        <h2>Foods on Your Search <a href="#" class="text-white">"
                <?php echo $search; ?>"
            </a></h2>
    </div>
</div>
<!-- End Hero Section -->



<!-- Product Menu Section Starts Here -->
<section class="product-menu">
    <div class="container">
        <?php
        // Get the search keyword
        $search = $_POST['search'];

        // SQl Query to get product based on search keyword
        $sql = "SELECT  * FROM tbl_product WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Count Rows
        $count = mysqli_num_rows($res);

        // Check whether product available or not
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                // Get the details
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>
                <div class="product-menu-box">
                    <div class="product-menu-img">
                        <?php
                        if ($image_name == "") {
                            // Display message
                            echo "<div class='error'>Image Not Available</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" alt="Chicken Hawaian Pizza"
                                class="img-fluid product-thumbnail">
                            <?php
                        }
                        ?>
                    </div>

                    <div class="product-menu-desc">
                        <h4>
                            <?php echo $title; ?>
                        </h4>
                        <p class="product-price">RM
                            <?php echo $price; ?>
                        </p>
                        <p class="product-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL ?>order.php?product_id=<?php echo $id; ?>" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
                <?php
            }
        } else {
            // product not found
            echo "<div class='error'>Product Not Found.</div>";

        }
        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- Product Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>


</body>

</html>