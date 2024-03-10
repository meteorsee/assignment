<?php include('../config/constants.php'); ?>

<?php 
    // Check if the user is logged in
    if(!isset($_SESSION['user'])) {
        // If the user is not logged in, redirect them to the login page
        header('location: user-login.php');
        exit(); // Stop further execution
    }

    // Get the logged-in user's username
    $username = $_SESSION['user'];

    // Query to fetch user data from tbl_user
    $sql = "SELECT * FROM tbl_user WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if($result) {
        // Fetch user data
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone_no = $row['phone_no'];
        // You can fetch other user data here as needed
    } else {
        // If the query fails, display an error message
        echo "Failed to fetch user data. Please try again.";
    }

    // Logout process
    if(isset($_POST['logout'])) {
        // Destroy the session data
        session_destroy();

        // Redirect the user to the login page
        header('location:'.SITEURL);
        exit(); // Stop further execution
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
    <!-- Include your CSS files here -->
</head>
<body>
    <h1>Welcome to Your Account, <?php echo $first_name; ?>!</h1>
    <!-- Display user information -->
    <p><strong>First Name:</strong> <?php echo $first_name; ?></p>
    <p><strong>Last Name:</strong> <?php echo $last_name; ?></p>
    <p><strong>Username:</strong> <?php echo $username; ?></p>
    <p><strong>Phone Number:</strong> <?php echo $phone_no; ?></p>
    <!-- Add more user information as needed -->

    <!-- Logout button -->
    <form action="" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>

    <!-- Include your footer here -->
</body>
</html>
