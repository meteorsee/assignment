<?php include('partials-front/navbar.php') ?>

<?php
if (isset($_SESSION['user'])) {
    // Retrieve the username from the session
    $username = $_SESSION['user'];
    //echo $username;
    if (isset($_SESSION['invoice'])) {
        $invoiceNumber = $_SESSION['invoice'];
        //echo "Invoice Number: " . $invoiceNumber;
    } else {
        echo "Invoice Number not found.";
    }

    // Query to fetch the user information based on the username
    $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        // Fetch user details
        $row = mysqli_fetch_assoc($res);
        $userId = $row['id'];

    } else {
        // If the user information is not found in the database, handle the error
        echo "Error: User information not found.";
    }
} else {
    // If the user is not logged in, redirect them to the login page
    //header('location: user-login.php');
    echo "<script type='text/javascript'>window.location.href = 'user-login.php';</script>";
    exit(); // Stop further execution
}


// if (isset($_SESSION['order-success'])) {
//     echo $_SESSION['order-success'];
//     unset($_SESSION['order-success']);
// }
if (isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
?>
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Payment</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="h3 mb-3 text-black">Your Order </h2>
                <div class="p-3 p-lg-5 border bg-white mb-5">
                    <h4 class="h4 mb-3 text-black">Inovice Number:
                        <?php echo $invoiceNumber; ?>
                    </h4>
                    <table class="table site-block-order-table mb-5">
                        <thead>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                            <?php
                            // Query to fetch all products in the cart for the current user
                            $sql2 = "SELECT * FROM tbl_order WHERE invoice_number = '$invoiceNumber'";
                            $res2 = mysqli_query($conn, $sql2);
                            $subtotal = 0;

                            if (mysqli_num_rows($res2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    $title = $row2['product_title'];
                                    $qty = $row2['product_qty'];
                                    $total = $row2['product_total'];
                                    $subtotal += $total;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $title; ?>
                                        </td>
                                        <td>
                                            <?php echo $qty; ?>
                                        </td>
                                        <td>RM
                                            <?php echo $total; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td class="text-black font-weight-bold" colspan="2"><strong>Cart Subtotal</strong></td>
                                <td class="text-black">
                                    <?php echo "RM " . number_format($subtotal, 2); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-black font-weight-bold" colspan="2"><strong>Order Total</strong></td>
                                <td class="text-black font-weight-bold"><strong>RM
                                        <?php echo number_format($subtotal, 2); ?>
                                    </strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="border p-3 mb-3">
                        <h3 class="h6 mb-0">Payment Details</h3>
                        <div class="py-2">
                            <form method="POST" id="bankTransferForm" enctype="multipart/form-data" onsubmit="return validateBankNumber()">
                                <div class="mb-3">
                                    <label for="bankName" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" id="bankName" name="bankName">
                                </div>
                                <div class="mb-3">
                                    <label for="bank_account_number" class="form-label">Bank Account Number</label>
                                    <input type="text" class="form-control" id="bank_account_number"
                                        name="bank_account_number">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                                <input type="hidden" name="invoice_number" value="<?php echo $invoiceNumber; ?>">
                                <button type="submit" name="submit_payment"
                                    class="btn btn-primary btn-lg btn-block">Submit Payment</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST["submit_payment"])) {

    $userId = $_POST['user_id'];
    $bankName = $_POST['bankName'];
    $bank_account_number = $_POST['bank_account_number'];
    //$bank_image_name = "";

    if(isset($_FILES['image']['name'])){
        // Upload the image
        // To upload the image we need the image name, source path and destination path
        $image_name = $_FILES['image']['name'];

        // Upload the image only if the image is selected
        if($image_name != ""){


        // Auto Rename the uploaded image
        // Get the extension of our image
        $image_name_parts = explode('.', $image_name);
        $ext = end($image_name_parts);

        // Rename the image
        $image_name = $invoiceNumber.'.'.$ext;

        $source_path = $_FILES['image']['tmp_name'];

        $destination_path = "images/payment/".$image_name;

        // Upload the image
        $upload = move_uploaded_file($source_path, $destination_path);
        
        // Check whether the image is uploaded or not
        // And if the image is not uploaded then we will stop the process and redirect with error message

        if($upload == false){
            // Set message
            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
            
            // Redirect to Add Category page
            echo "<script type='text/javascript'>window.location.href = 'payment.php';</script>";

            // Stop the process
            die();
        }

    }
    }else{
        // Dont upload the iamge and set the image name as blank value
        $image_name = '';
    }

    $sql3 = "UPDATE tbl_order SET 
            status = 'Done Payment'
            WHERE invoice_number = '$invoiceNumber'";

    $res3 = mysqli_query($conn, $sql3);

    if ($res3 == true) {
        //Successful update category
        //$_SESSION['update-status'] = "<div class='success'>Category Update Successfully.</div>";
    } else {
        //Successful update category
        //$_SESSION['update-status'] = "<div class='error'>Failed to Update Category.</div>";
    }


    $sql4 = "INSERT INTO tbl_payment SET
            user_id = '$userId',
            invoice_number = '$invoiceNumber',
            bank_name = '$bankName',
            bank_account_number = '$bank_account_number',
            image_name = '$image_name',
            payment_date = NOW()";


    $res4 = mysqli_query($conn, $sql4);
    if ($res4 == true) {
        //Payment Successful
        // if (isset($_SESSION ['invoice'])) {
        //     echo $_SESSION['invoice'];
        //     //unset($_SESSION['invoice']);
        // }
        echo "<script type='text/javascript'>window.location.href = 'thankyou.php';</script>";
    } else {
        //Payment Failed
        $_SESSION['update-status'] = "<div class='error'>Failed to Submit Payment.</div>";
    }
}
?>

<?php include('partials-front/footer.php') ?>
<script>
    function validateBankNumber() {
        var bankNumber = document.getElementById("bank_account_number").value;
        var regex = /^\d+$/; // Regular expression to match digits only

        if (!regex.test(bankNumber)) {
            alert("Bank account number must contain digits only.");
            return false;
        }
        return true;
    }

</script>