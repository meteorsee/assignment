<?php include('../config/constants.php') ?>

<html>
<head>
    <title>Register - Food Order System</title>
    <link rel="stylesheet" href="../css/user-login-register.css">
</head>

<body>
<div class="login">
    <h1 class="text-center">Register</h1>
    <br><br>

    

    <br><br>
    <!--START Registration Form-->
    <form action="" method="POST" class="text-center">
        First Name: <br>
        <input type="text" name="first_name" placeholder="Enter first name"> <br><br>
        Last Name: <br>
        <input type="text" name="last_name" placeholder="Enter last name"> <br><br>
        Username: <br>
        <input type="text" name="username" placeholder="Enter username"> <br><br>
        Phone Number: <br>
        <input type="text" name="phone_no" placeholder="Enter Phone Number"> <br><br>
        Password: <br>
        <input type="password" name="password" placeholder="Enter Password"><br><br>
        Confirm Password: <br>
        <input type="password" name="confirm_password" placeholder="Enter Confirm Password"><br><br>
        <input type="submit" name="submit" value="Register" class="btn-primary">
        <br><br>
        <p>Already have account? <a href="user-login.php">Login Now</a></p>
    </form>
    <!--END Registration Form-->
    <p class="text-center">Created by - <a href="www.meteor.com">Meteor</a></p>

</div>

</body>
</html>

<?php
// Check whether submit button is clicked
if(isset($_POST['submit'])){
    // Process for registration
    // Get Data from Registration Form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $password = md5($_POST['password']); // You should use more secure methods like password_hash() for password hashing
    $confirm_password = md5($_POST['confirm_password']); // You should use more secure methods like password_hash() for password hashing

    // Check if password and confirm password match
    if($password !== $confirm_password) {
        $_SESSION['register'] = "<div class='error text-center'>Password and Confirm Password do not match. Please try again.</div>";
        header('location:'.SITEURL.'/user-register.php');
        exit(); // Stop further execution
    }

    // Check if the username already exists
    $sql_check_username = "SELECT * FROM tbl_user WHERE username='$username'";
    $res_check_username = mysqli_query($conn, $sql_check_username);
    $count_check_username = mysqli_num_rows($res_check_username);

    if($count_check_username > 0){
        // Username already exists
        $_SESSION['register'] = "<div class='error text-center'>Username already exists. Please choose a different username.</div>";
        header('location:'.SITEURL.'/user-register.php');
    }else{
        // Insert user into database
        $sql = "INSERT INTO tbl_user (first_name, last_name, username, phone_no, password) VALUES ('$first_name', '$last_name', '$username', '$phone_no', '$password')";
        $res = mysqli_query($conn, $sql);

        if($res){
            // Registration successful
            $_SESSION['register'] = "<div class='success'>Registration Successful.</div>";
            header('location:'.SITEURL.'user/user-login.php');
        }else{
            // Registration failed
            $_SESSION['register'] = "<div class='error text-center'>Registration failed. Please try again.</div>";
            header('location:'.SITEURL.'user/user-register.php');
        }
    }
}
?>
