<?php include("partials-front/navbar.php"); ?>

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Category</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">

            <?php
            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                // Products available
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the values like id, title, price, image_name
                    $id = $row["id"];
                    $title = $row["title"];
                    $image_name = $row["image_name"];
                    ?>

                    <!-- Start Column 1 -->
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                        <a class="product-item" href="<?php echo SITEURL; ?>category-product.php?category_id=<?php echo $id ?>">
                            <?php
                            if ($image_name == "") {
                                // Display message
                                echo "<div class='error'>Image Not Available</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Product Image"
                                    class="img-fluid product-thumbnail">
                                <?php
                            }
                            ?>
                            <h3 class="product-title">
                                <?php echo $title; ?>
                            </h3>
                        </a>
                    </div>
                    <!-- End Column 1 -->
                    <?php
                }
            } else {
                // No products available
                echo "<div class='error'>No Products Available</div>";
            }
            ?>
        </div>
    </div>
</div>

<?php include("partials-front/footer.php"); ?>