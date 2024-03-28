<?php include('partials-front/navbar.php'); 
?>


    <head>
        <title>Login - Gadget Galaxy</title>
        <link rel="stylesheet" href="css/user-login-register.css">
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
                <p>No Account yet? <a href="user-register.php">Register Now</a></p>
            </form>
            <!--END Login Form-->
        </div>

    </body>
</html>

<?php 
    //Check whether submit button is click
    if(isset($_POST['submit'])){
        // Process for login
        // Get Data fron Login Form

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5(mysqli_real_escape_string($conn, $_POST['password']));


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
        $sql = "SELECT * FROM tbl_user WHERE username='$username' AND PASSWORD='$password'";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1){
            // User available
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; // To check whether the user is logged in or not and logout will unset it
            header('location:'.SITEURL);
            exit();

        }else{
            // User not available
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'user-login.php');
            exit();

        }

    }

?>

<?php include('partials-front/footer.php'); ?>
