<?php include('partials/menu.php');?>
        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Order</h1>
                
                <br/><br/>

                <?php
                    
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update']; // Display session message
                        unset($_SESSION['update']); // Remove session message
                    }
                        
                ?>
<br/>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Customer Name</th>
                        <th>Phone No</th>
                        <th>Message Date</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_contact ORDER BY id DESC";

                        $res = mysqli_query($conn, $sql);

                        // Check whether there's data in the databse                            
                        $count = mysqli_num_rows($res);
                        $sn=1;
                            if($count>0){
                                // There's data in the database
                                // Get the order data from the database and display it
                                while($row = mysqli_fetch_assoc($res)){
                                    $id = $row["id"];
                                    $first_name = $row["first_name"];
                                    $last_name = $row["last_name"];
                                    $phone_no = $row["phone_no"];
                                    $message_date = $row["message_date"];
                                    $email = $row["email"];
                                    $message = $row["message"];
                                    $status = $row["status"];
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++;?></td>
                                        <td><?php echo $first_name; ?> <?php echo $last_name ?></td>
                                        <td><?php echo $phone_no;?></td>
                                        <td><?php echo $message_date;?></td>
                                        <td><?php echo $email;?></td>
                                        <td><?php echo $message;?></td>
                                        <td>
                                            <?php 
                                                if($status=="Received"){
                                                    echo "<label>$status</label>";
                                                }elseif($status=="Pending Reply"){
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }elseif($status=="Replied"){
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-contact.php?id=<?php echo $id; ?>" class="btn-secondary" >Update Status</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }else{
                                // There's no data in the database
                                ?>
                                echo "<tr><td colspan="12"><div class="error">Orders Not Available.</div></td></tr>"
                                <?php
                            }
                    ?>

                        

                    <?php    
                        
                    ?>

                    
                </table>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php');?>