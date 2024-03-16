<?php include('partials/menu.php'); ?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

        <br><br>

        <div class="col-4 text-center">
            <?php
            // SQL Query
            $sql = "SELECT * FROM tbl_category";

            // Execute Query
            $res = mysqli_query($conn, $sql);

            // Count the rows
            $count = mysqli_num_rows($res);

            ?>
            <h1>
                <?php echo $count; ?>
            </h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <?php
            // SQL Query
            $sql2 = "SELECT * FROM tbl_product";

            // Execute Query
            $res2 = mysqli_query($conn, $sql2);

            // Count the rows
            $count2 = mysqli_num_rows($res2);

            ?>
            <h1>
                <?php echo $count2; ?>
            </h1>
            <br />
            Product
        </div>

        <div class="col-4 text-center">
            <?php
            // SQL Query
            $sql3 = "SELECT COUNT(DISTINCT invoice_number) AS TotalOrders FROM tbl_order WHERE status != 'Cancelled'";

            // Execute Query
            $res3 = mysqli_query($conn, $sql3);

            // Count the rows
            $count3 = mysqli_num_rows($res3);

            ?>
            <h1>
                <?php echo $count3; ?>
            </h1>
            <br />
            Total Orders
        </div>

        <div class="col-4 text-center">
            <?php
            // SQL Query
            $sql4 = "SELECT SUM(product_total) AS Total FROM tbl_order";

            // Execute Query
            $res4 = mysqli_query($conn, $sql4);

            // Get the value
            $row4 = mysqli_fetch_assoc($res4);

            // Check if Total is not null or empty
            if (!empty($row4['Total'])) {
                $total_revenue = number_format($row4['Total'], 2); 
            } else {
                $total_revenue = number_format(0, 2); 
            }

            ?>
            <h1>RM
                <?php echo $total_revenue; ?>
            </h1> <br />
            Revenue Generated
        </div>

        <div class="col-4 text-center">
            <?php
            // SQL Query
            $sql5 = "SELECT * FROM tbl_contact";

            // Execute Query
            $res5 = mysqli_query($conn, $sql5);

            // Count the rows
            $count5 = mysqli_num_rows($res5);

            ?>
            <h1>
                <?php echo $count5; ?>
            </h1>
            <br />
            Total Messages
        </div>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Setion Ends -->

<?php include('partials/footer.php'); ?>