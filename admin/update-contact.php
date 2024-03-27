<?php include('partials/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Contact</h1>
            <br><br>

            <?php
            // Check whether the id is set or not
            if(isset($_GET['id'])){
                // Get the ID and all other details
                $id = $_GET['id'];
                
                // Create the SQL Query to get all the details
                $sql = "SELECT * FROM tbl_contact WHERE id=$id";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count == 1){
                    // Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $first_name = $row["first_name"];
                    $last_name = $row["last_name"];
                    $phone_no = $row["phone_no"];
                    $message_date = $row["message_date"];
                    $email = $row["email"];
                    $message = $row["message"];
                    $status = $row["status"];

                }else{
                    // Redirect to manage category page
                    $_SESSION['no-category-found'] = "<div class='error'>Message Not Found.</div>";
                    header("location:".SITEURL."admin/manage-contact.php");

                }
            }else{
                // Redirect to Manage Category Page
                header("location:".SITEURL."admin/manage-contact.php");
            }
        ?>
        <form action="" method="POST">

                <table class="tbl-30">
                <tr>
                    <td>Customer Name: </td>
                    <td><?php echo $first_name; ?> <?php echo $last_name ?></td>
                </tr>
                <tr>
                    <td>Phone Number: </td>
                    <td><?php echo $phone_no;?></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><?php echo $email;?></td>
                </tr>
                <tr>
                    <td>Message Date: </td>
                    <td><?php echo $message_date;?></td>
                </tr>
                <tr>
                    <td>Message Date: </td>
                    <td><?php echo $message;?></td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Received"){echo "selected";} ?> value="Received">Received</option>
                            <option <?php if($status=="Pending Reply"){echo "selected";} ?> value="Pending Reply">Pending Reply</option>
                            <option <?php if($status=="Replied"){echo "selected";} ?> value="Replied">Replied</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Status" class="btn-secondary">
                    </td>
                </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['submit'])){
                    // Get all the values from the form
                    $status = mysqli_real_escape_string($conn, $_POST["status"]);

                    // Update the database
                    $sql2 = "UPDATE tbl_contact SET
                        status = '$status'
                        WHERE id=$id
                        ";
                    
                    // Execute the query
                    $res2=mysqli_query($conn,$sql2);

                    // Redirect  to manage category page
                    // Check if the query executed
                    if($res2==true){
                        //Successful update category
                        $_SESSION['update'] = "<div class='success'>Contact Status Updated Successfully.</div>";
                        header("location:".SITEURL."admin/manage-contact.php");
                    }else{
                        //Successful update category
                        $_SESSION['update'] = "<div class='error'>Failed to Contact Status.</div>";
                        header("location:".SITEURL."admin/manage-contact.php");
                    }

                }
            ?>
        </div>
    </div>

<?php include('partials/footer.php');?>