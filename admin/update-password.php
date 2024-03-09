<?php
    include("partials/menu.php");
?>

    <div class="main-content">
        <div class = "wrapper">
            <h1>Change Password</h1>

            <br/><br/>
            
            <?php
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                }
                
            ?>
            <form action"" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </div>

<?php
    // Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){

        // Get password values from form to update
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);


        // Check whether the user with the current ID and current password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND PASSWORD='$current_password'";
        
        
        // Execute the query
        $res = mysqli_query($conn, $sql);

        if($res==true){
            // Check whether the data is available
            $count= mysqli_num_rows($res);

            if($count == 1){
                // User exists and password can be changed
                // Check whether the New Password and the Confirm Password match or not
                if($new_password == $confirm_password){
                    // Update the password
                    $sql2 = "UPDATE tbl_admin SET 
                    PASSWORD='$new_password' 
                    WHERE id=$id
                    ";

                    // Execure the query
                    $res2 = mysqli_query($conn, $sql2);

                    // Check whether the query executed
                    if($res2==true){
                        // Display success message
                        // Redirect to Manage Admin Page with success message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }else{
                        // Display error message
                        // Redirect to Manage Admin Page with error message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }

                }else{
                    // Redirect to Manage Admin Page with error message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Entered Password Does Not Match.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }else{
                // User does not exist set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }        
 
    }
?>

<?php
    include("partials/footer.php");
?>