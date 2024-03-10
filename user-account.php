<?php include('partials-front/navbar.php'); ?>

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

    // Fetch past purchases (sample query, adjust as per your database structure)
    // $pastPurchases = []; // Array to hold past purchases
    // $queryPastPurchases = "SELECT * FROM tbl_order WHERE id = '$id'";
    // $resultPastPurchases = mysqli_query($conn, $queryPastPurchases);
    // if($resultPastPurchases && mysqli_num_rows($resultPastPurchases) > 0) {
    //     while($row = mysqli_fetch_assoc($resultPastPurchases)) {
    //         $pastPurchases[] = $row;
    //     }
    // }

    // Logout process
    if(isset($_POST['logout'])) {
        // Destroy the session data
        session_destroy();

        // Redirect the user to the login page
        header('location: user-login.php');
        exit(); // Stop further execution
    }
?>

    <title>User Account</title>
    <!-- Include your CSS files here -->
    <style>
        
        .container-acc {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            width: 20%;
        }

        .main-content {
            width: 75%;
        }

        h1-acc {
            color: #333;
            margin-top: 0;
        }

        p-acc {
            color: #555;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }

        .sidebar ul li a:hover {
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="container-acc">
        <div class="sidebar">
            <h2>My Account</h2>
            <ul>
                <li><a href="#profile">My Profile</a></li>
                <li><a href="#orders">Past Orders</a></li>
                <li><a href="#password">Change Password</a></li>
                <!-- Add more links as needed -->
            </ul>

            <!-- Logout button -->
            <form action="" method="post" class="logout-form">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
        <div class="main-content">
            <h1>Welcome to Your Account, <?php echo $first_name; ?>!</h1>
            <!-- Display user information -->
            <p><strong>First Name:</strong> <?php echo $first_name; ?></p>
            <p><strong>Last Name:</strong> <?php echo $last_name; ?></p>
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Phone Number:</strong> <?php echo $phone_no; ?></p>
            <!-- Add more user information as needed -->

            <!-- Display past purchases -->
            <h2 id="orders">Past Purchases</h2>
            <ul>
                <?php foreach($pastPurchases as $purchase): ?>
                    <li><?php echo $purchase['product_name']; ?> - <?php echo $purchase['purchase_date']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!-- Include your footer here -->
    <?php include('partials-front/footer.php'); ?>
</body>
</html>
