<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
        // Check whether the id is set or not
        if(isset($_GET['id'])){
            // Get the ID and all other details
            $id = $_GET['id'];

            // Create the SQL Query to get all the details
            $sql = "SELECT * FROM tbl_order WHERE id=$id";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check if query executed successfully
            if($res){
                // Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count == 1){
                    // Get order details
                    $row = mysqli_fetch_assoc($res);
                    $invoice_number = $row["invoice_number"];
                    $product_title = $row["product_title"];
                    $product_qty = $row["product_qty"];
                    $product_total = $row["product_total"];
                    $order_date = $row["order_date"];
                    $status = $row["status"];
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $email = $row["email"];
                    $phone_no = $row["phone_no"];
                    $address = $row["address"];
                } else {
                    // Redirect to manage order page if order not found
                    $_SESSION['update'] = "<div class='error'>Order not found.</div>";
                    header("location:".SITEURL."admin/manage-order.php");
                    exit; // Stop further execution
                }
            } else {
                // Redirect with error message if query fails
                $_SESSION['update'] = "<div class='error'>Failed to retrieve order details.</div>";
                header("location:".SITEURL."admin/manage-order.php");
                exit; // Stop further execution
            }
        } else {
            // Redirect if order ID is not set
            header("location:".SITEURL."admin/manage-order.php");
            exit; // Stop further execution
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Invoice Number: </td>
                    <td><b><?php echo $invoice_number; ?></b></td>
                </tr>
                <tr>
                    <td>Product Title: </td>
                    <td><b><?php echo $product_title;?></b></td>
                </tr>
                <tr>
                    <td>Quantity: </td>
                    <td><input type="number" name="qty" value="<?php echo $product_qty;?>"></td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Done Payment"){echo "selected";} ?> value="Done Payment">Done Payment</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="customer_name" value="<?php echo $first_name . ' ' . $last_name; ?>"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                    <td>Contact Number: </td>
                    <td><input type="text" name="phone_no" value="<?php echo $phone_no; ?>"></td>
                </tr>
                <tr>
                    <td>Address: </td>
                    <td><textarea name="address" cols="30" rows="5"><?php echo $address; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['submit'])){
            // Get form data
            $qty = $_POST['qty'];
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $email = $_POST['email'];
            $phone_no = $_POST['phone_no'];
            $address = $_POST['address'];

            // Update the database
            $sql2 = "UPDATE tbl_order SET
                            product_qty = '$qty',
                            status = '$status',
                            first_name = '$customer_name',
                            email = '$email',
                            phone_no = '$phone_no',
                            address = '$address'
                    WHERE id=$id";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            if($res2){
                // Successful update
                $_SESSION['update'] = "<div class='success'>Order updated successfully.</div>";
            } else {
                // Failed update
                $_SESSION['update'] = "<div class='error'>Failed to update order.</div>";
            }

            // Redirect to manage order page
            header("location:".SITEURL."admin/manage-order.php");
            exit; // Stop further execution
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>
