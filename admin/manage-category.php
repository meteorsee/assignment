<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br/>

            <br/><br/>
            <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add']; // Display session message
                        unset($_SESSION['add']); // Remove session message
                    }

                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove']; // Display session message
                        unset($_SESSION['remove']); // Remove session message
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete']; // Display session message
                        unset($_SESSION['delete']); // Remove session message
                    }

                    if(isset($_SESSION['no-category-found'])){
                        echo $_SESSION['no-category-found']; // Display session message
                        unset($_SESSION['no-category-found']); // Remove session message
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update']; // Display session message
                        unset($_SESSION['update']); // Remove session message
                    }

                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload']; // Display session message
                        unset($_SESSION['upload']); // Remove session message
                    }

                    if(isset($_SESSION['failed-remove'])){
                        echo $_SESSION['failed-remove']; // Display session message
                        unset($_SESSION['failed-remove']); // Remove session message
                    }
            
            ?>
            <br><br>

            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                
                <br/><br/><br/>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_category";

                        $res = mysqli_query($conn, $sql);

                        // Check whether there's data in the databse                            
                        $count = mysqli_num_rows($res);
                        $sn=1;
                            if($count>0){
                                // There's data in the database
                                // Get the data from the database and display it
                                while($row = mysqli_fetch_array($res)){
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name = $row['image_name'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++;?></td>
                                        <td><?php echo $title;?></td>
                                        <td>
                                            <?php 
                                                // Check whether the image name is available
                                                if($image_name!=""){
                                                    // Display the image
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                                    <?php
                                                }else{
                                                    // Display the message
                                                    echo "<div class='error'>No Image Added.</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured;?></td>
                                        <td><?php echo $active;?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary" >Update Category</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }else{
                                // There's no data in the database
                                ?>
                                <tr>
                                <td colspan="6"><div class="error">No Category Added.</div></td>
                                </tr>
                                <?php
                            }
                    ?>

                        

                    <?php    
                        
                    ?>

                    
                </table>
        </div>
    </div>

<?php include('partials/footer.php'); ?>