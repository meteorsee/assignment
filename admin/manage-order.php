<?php include('partials/menu.php');?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        
        <br/><br/><br/>

        <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update']; // Display session message
                unset($_SESSION['update']); // Remove session message
            }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Invoice Number</th>
                <th>Product</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);

                // Check whether there's data in the database                            
                $count = mysqli_num_rows($res);
                $sn=1;
                if($count > 0){
                    // There's data in the database
                    // Get the order data from the database and display it
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row["id"];
                        $invoice_number = $row["invoice_number"];
                        $product_title = $row["product_title"];
                        //$product_price = $row["product_price"];
                        $product_qty = $row["product_qty"];
                        $product_total = $row["product_total"];
                        $order_date = $row["order_date"];
                        $status = $row["status"];
                        $first_name = $row["first_name"];
                        $last_name = $row["last_name"];
                        $email = $row["email"];
                        $phone_no = $row["phone_no"];
                        $address = $row["address"];

                        ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $invoice_number;?></td>
                            <td><?php echo $product_title;?></td>
                            <td><?php echo $product_qty;?></td>
                            <td>RM<?php echo $product_total;?></td>
                            <td><?php echo $order_date;?></td>
                            <td>
                                <?php 
                                    if($status == "Order Received"){
                                        echo "<label style='color: black;'>$status</label>";
                                    } elseif($status == "Delivered"){
                                        echo "<label style='color: green;'>$status</label>";
                                    } elseif($status == "Pending Delivery"){
                                        echo "<label style='color: orange;'>$status</label>";
                                    }elseif($status == "Cancelled"){
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $first_name . " " . $last_name;?></td>
                            <td><?php echo $phone_no;?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $address;?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary" >Update Order</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // There's no data in the database
                    echo "<tr><td colspan='13'><div class='error'>Orders Not Available.</div></td></tr>";
                }
            ?>
        </table>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Setion Ends -->

<?php include('partials/footer.php');?>
