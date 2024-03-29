<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br/><br/>

        <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
        ?>


        <form action"" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your Username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php");?>

<?php
    if(isset($_POST['submit'])){
        // Get data from form
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5(mysqli_real_escape_string($conn, $_POST['password']));  // Password encryption with MD5
    
        // SQL Query to save data into database
        $sql = "INSERT INTO tbl_admin SET 
                full_name='$full_name',
                username='$username',
                password='$password'
                ";
        
        // Execute query and save data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // Check whether the query is executed and data is inserted or not and display appriopriate message
        if($res == TRUE){
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }else{
            $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>