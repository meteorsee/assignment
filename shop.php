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
        </div>
        <!-- Product Search Section Starts Here -->
        <section class="product-search text-center">
            <div class="container">
                <form action="<?php echo SITEURL; ?>product-search.php" method="POST">
                    <input type="search" name="search" placeholder="Search for Product.." required>
                    <input type="submit" name="submit" value="Search" class="btn btn-secondary">
                </form>
            </div>
        </section>
        <!-- Product Search Section Ends Here -->
    </div>
</div>
<!-- End Hero Section -->
<?php
// Check if the 'added' query parameter is set to true
if(isset($_GET['added']) && $_GET['added'] == 'true') {
    echo "<script>alert('Item added to cart successfully!');</script>";
}
?>

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">
            <!-- Sidebar for Category Filtering -->
            <div class="col-lg-3">
                <div class="sidebar-shop">
                    <h2>Categories</h2>
                    <ul>
                        <?php
                        $sql_categories = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                        $res_categories = mysqli_query($conn, $sql_categories);

                        if (mysqli_num_rows($res_categories) > 0) {
                            while ($row_category = mysqli_fetch_assoc($res_categories)) {
                                $category_id = $row_category['id'];
                                $category_title = $row_category['title'];
                                ?>
                                <li><a href="<?php echo SITEURL; ?>category-product.php?category_id=<?php echo $category_id; ?>"><?php echo $category_title; ?></a></li>
                            <?php }
                        } else {
                            echo "<li>No Categories Found</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- End Sidebar -->

            <!-- Product Section -->
            <div class="col-lg-9">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM tbl_product WHERE active = 'Yes'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        // Products available
                        while ($row = mysqli_fetch_assoc($res)) {
                            // Get the values like id, title, price, image_name
                            $id = $row["id"];
                            $title = $row["title"];
                            $description = $row["description"];
                            $price = $row['price'];
                            $image_name = $row["image_name"];
                            ?>
                            <!-- Start Column 1 -->
                            <div class="col-12 col-md-4 col-lg-4 mb-5">
                                <a class="product-item add-to-cart-link " href="<?php echo SITEURL; ?>add-to-cart.php?id=<?php echo $id; ?>" >
                                    <?php
                                    if ($image_name == "") {
                                        // Display message
                                        echo "<div class='error'>Image Not Available</div>";
                                    } else {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/products/<?php echo $image_name; ?>" alt="Product Image"
                                            class="img-fluid product-thumbnail">
                                        <?php
                                    }
                                    ?>
                                    <h3 class="product-title">
                                        <?php echo $title; ?>
                                    </h3>
                                    <strong class="product-price">RM
                                        <?php echo $price; ?>
                                    </strong>
                                        <?php echo "<p>".$description."</p>"; ?>
                                    <span class="icon-cross">
                                        <img src="images/cross.svg" class="img-fluid">
                                    </span>
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
            <!-- End Product Section -->
        </div>
    </div>
</div>

<?php include("partials-front/footer.php"); ?>


<script>
    $(document).ready(function() {
        $('.add-to-cart-link').on('click', function(event) {
            event.preventDefault();
            var productId = $(this).data('productid');
            console.log('Product ID:', productId); // Temporary log statement for debugging
            addToCart(productId);
        });


        function addToCart(productId) {
            // Send AJAX request to add the item to the cart
            $.ajax({
                url: 'add-to-cart.php',
                method: 'POST',
                data: { id: productId },
                success: function(response) {
                    // Handle the response, e.g., update cart icon or display a success message
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
