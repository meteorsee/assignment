<?php include('../config/constants.php');
$_SESSION['last_timestamp'] = time();
if (isset($_GET['session_expired']) && $_GET['session_expired'] == 1) {
    echo "<script>alert('Your session has expired. Please log in 
again.');</script>";
    session_destroy();
    }
    echo "<script>window.history.replaceState({}, document.title, window.location.pathname);</script>";

?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin-login.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>
            <br><br>
            <!--START Login Form-->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter username"> <br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <input type="checkbox" name="remember_me"> Remember Me<br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!--END Login Form-->
            <p class="text-center">Created by - <a href="www.meteor.com">Meteor</a></p>

        </div>

    </body>
</html>

<?php 
    //Check whether submit button is click
    if(isset($_POST['submit'])){
        // Process for login
        // Get Data fron Login Form

        $username = $_POST['username'];
        $password = md5($_POST['password']);


        if(isset($_POST['remember_me'])){
            // Set cookies for username and password
            setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie('password', $password, time() + (86400 * 30), "/"); // Change "30" to the number of days you want to remember the user
        } else {
            // If "Remember Me" is not checked, unset the cookies
            setcookie('username', '', time() - 3600, "/");
            setcookie('password', '', time() - 3600, "/");
        }

        // Check SQL whether the username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND PASSWORD='$password'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1){
            // User available
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION["user"] = $username; // To check whether the user is logged in or not and logout will unset it

            header('location:'.SITEURL.'admin/');
        }else{
            // User not available
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>