<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
            // Check whether the id is set or not
            if(isset($_GET["id"])){
                // Get the ID and all other details
                $id = $_GET['id'];
                
                // Create the SQL Query to get all the details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count == 1){
                    // Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                }else{
                    // Redirect to manage category page
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                    header("location:".SITEURL."admin/manage-category.php");

                }
            }else{
                // Redirect to Manage Category Page
                header("location:".SITEURL."admin/manage-category.php");
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != ""){
                                // Display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                                <?php
                            }else{
                                // Display the message
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td><input 
                            <?php 
                                if($featured=="Yes"){
                                    echo "Checked"; 
                                }
                            ?>
                            type="radio" name="featured" value="Yes">
                        Yes
                    </td>
                    <td><input 
                            <?php 
                                if($featured=="No"){
                                    echo "Checked"; 
                                }
                            ?>
                            type="radio" name="featured" value="No">
                            No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td><input 
                            <?php 
                                if($active=="Yes"){
                                    echo "Checked"; 
                                }
                            ?>
                            type="radio" name="active" value="Yes">
                            Yes
                    </td>
                    <td><input 
                            <?php 
                                if($active=="No"){
                                    echo "Checked"; 
                                }
                            ?>
                            type="radio" name="active" value="No">
                            No
                        </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['submit'])){
                    // Get all the values from the form
                    $id = mysqli_real_escape_string($conn, $_POST['id']);
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
                    $featured = mysqli_real_escape_string($conn, $_POST['featured']);
                    $active = mysqli_real_escape_string($conn, $_POST['active']);

                    // Update the new image if selected
                    // Check whether the image is selected or not
                    if(isset($_FILES['image']['name'])){
                        // Get the image details
                        $image_name = $_FILES['image']['name'];
                        if($image_name != ""){
                            // Image Available
                            // Upload the NEW image

                            // Auto Rename the uploaded image
                            // Get the extension of our image
                            $ext = end(explode(".", $image_name));

                            // Rename the image
                            $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            // Upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);
                        
                            // Check whether the image is uploaded or not
                            // And if the image is not uploaded then we will stop the process and redirect with error message

                            if($upload == false){
                                // Set message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            
                                // Redirect to Add Category page
                                header("location:".SITEURL."admin/add-category.php");

                                // Stop the process
                                die();
                            }

                            // Remove the CURRENT image if available
                            if($current_image != ""){
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);

                                // Check whether the image is removed or not
                                // If failed to remove then display message and stop the process
                                if($remove == false){
                                    // Failed to remove image
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image.</div>";
                                    header("location:".SITEURL."admin/manage-category.php");

                                    // Stop the process
                                    die();
                                }
                            }
                            

                        }else{
                            $image_name = $current_image;
                        }
                    }else{
                        $image_name = $current_image;
                    }

                    // Update the database
                    $sql2 = "UPDATE tbl_category SET
                                    title = '$title',
                                    image_name = '$image_name',
                                    featured = '$featured',
                                    active = '$active'
                            WHERE id=$id
                            ";
                    
                    // Execute the query
                    $res2=mysqli_query($conn,$sql2);

                    // Redirect  to manage category page
                    // Check if the query executed
                    if($res2==true){
                        //Successful update category
                        $_SESSION['update'] = "<div class='success'>Category Update Successfully.</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                    }else{
                        //Successful update category
                        $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                    }

                }
            ?>

    </div>
</div>

<?php include("partials/footer.php"); ?>
