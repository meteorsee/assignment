<?php include ('partials-front/navbar.php'); 
?>
<?php
// Check if the user is logged in
if (!isset ($_SESSION['user'])) {
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
if ($result) {
    // Fetch user data
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $phone_no = $row['phone_no'];
    // You can fetch other user data here as needed
} else {
    // If the query fails, display an error message
    echo "Failed to fetch user data. Please try again.";
}


// Logout process
if (isset ($_POST['logout'])) {
    // Destroy the session data
    session_destroy();

    // Redirect the user to the login page
    header('location: user-login.php');
    exit(); // Stop further execution
}
?>
<link rel="stylesheet" type="text/css" href="css/user-account.css">


<div class="container-acc">
    <div class="sidebar-acc">
        <h2>My Account</h2>
        <ul>
            <li><a href="#" onclick="showSection('profile')">My Profile</a></li>
            <li><a href="#" onclick="showSection('orders')">Past Orders</a></li>
            <li><a href="#" onclick="showSection('tracking')">Track Orders</a></li>
            <li><a href="#" onclick="showSection('password')">Change Password</a></li>
        </ul>

        <!-- Logout button -->
        <form action="" method="post" class="logout-form">
            <input class="btn-secondary" type="submit" name="logout" value="Logout">
        </form>
    </div>
    <div class="main-content-acc">
        <div id="profile" style="display: none;">
            <!-- Profile content goes here -->
            <h1>Welcome to Your Profile,
                <?php echo $first_name; ?>!
            </h1>
            <p><strong>First Name:</strong>
                <?php echo $first_name; ?>
            </p>
            <p><strong>Last Name:</strong>
                <?php echo $last_name; ?>
            </p>
            <p><strong>Username:</strong>
                <?php echo $username; ?>
            </p>
            <p><strong>Phone Number:</strong>
                <?php echo $phone_no; ?>
            </p>

        </div>

        <div id="orders" style="display: none;">
            <!-- Past orders content goes here -->
            <h2>Past Purchases</h2>
            <table>
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_orders = "SELECT * FROM tbl_order WHERE user_id = '$id'";
                    $result_orders = mysqli_query($conn, $sql_orders);
                    if ($result_orders && mysqli_num_rows($result_orders) > 0) {
                        while ($row_order = mysqli_fetch_assoc($result_orders)) {
                            echo "<tr>";
                            echo "<td>" . $row_order['invoice_number'] . "</td>";
                            echo "<td>" . $row_order['product_title'] . "</td>";
                            echo "<td>" . $row_order['product_qty'] . "</td>";
                            echo "<td>$" . $row_order['product_price'] . "</td>";
                            echo "<td>$" . $row_order['product_total'] . "</td>";
                            echo "<td>" . $row_order['order_date'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No past purchases found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="tracking" style="display: none;">
            <!-- Past orders content goes here -->
            <h2>Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_orders = "SELECT * FROM tbl_order WHERE user_id = '$id'";
                    $result_orders = mysqli_query($conn, $sql_orders);
                    if ($result_orders && mysqli_num_rows($result_orders) > 0) {
                        while ($row_order = mysqli_fetch_assoc($result_orders)) {
                            echo "<tr>";
                            echo "<td>" . $row_order['invoice_number'] . "</td>";
                            echo "<td>" . $row_order['order_date'] . "</td>";
                            echo "<td>" . $row_order['status'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No Order found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <div id="password" style="display: none;">
            <!-- Change password content goes here -->
            <h2>Change Password</h2>
            <form action="" method="post">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required><br>

                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required><br>

                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br>

                <input type="submit" name="change_password" value="Change Password">
            </form>
        </div>
        <?php
        if (isset ($_POST['change_password'])) {
            // Fetch the current user's data
            $sql_user = "SELECT * FROM tbl_user WHERE id = '$id'";
            $result_user = mysqli_query($conn, $sql_user);
            // Change password process
            if (isset ($_POST['change_password'])) {
                $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
                $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
                $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

                // Fetch the current user's data
                $sql_user = "SELECT * FROM tbl_user WHERE id = '$id'";
                $result_user = mysqli_query($conn, $sql_user);
                if ($result_user && mysqli_num_rows($result_user) > 0) {
                    $user = mysqli_fetch_assoc($result_user);

                    // Verify if current password matches the one in the database (MD5 hashed)
                    if (md5($current_password) === $user['password']) {
                        // Verify if the new password and confirm password match
                        if ($new_password === $confirm_password) {
                            // Hash the new password using MD5
                            $hashed_password = md5($new_password);

                            // Update the password in the database
                            $update_sql = "UPDATE tbl_user SET password = '$hashed_password' WHERE id = '$id'";
                            $update_result = mysqli_query($conn, $update_sql);
                            if ($update_result) {
                                echo "Password changed successfully.";
                            } else {
                                echo "Failed to update password. Please try again.";
                            }
                        } else {
                            echo "New password and confirm password do not match.";
                        }
                    } else {
                        echo "Current password is incorrect. Please try again.";
                    }
                } else {
                    echo "Failed to fetch user data. Please try again.";
                }
            }
        }
        ?>

    </div>
</div>
<!-- Include your footer here -->
<?php include ('partials-front/footer.php'); ?>

<script>
    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.main-content-acc > div').forEach(function (section) {
            section.style.display = 'none';
        });

        // Show the selected section
        document.getElementById(sectionId).style.display = 'block';
    }
</script>