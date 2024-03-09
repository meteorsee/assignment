<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Product</h1>

        <br><br>

        <?php
            // Check whether the id is set or not
            if(isset($_GET["id"])){
                // Get the ID and all other details
                $id = $_GET['id'];
                
                // Create the SQL Query to get all the details
                $sql = "SELECT * FROM tbl_product WHERE id=$id";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count the rows to check whether the id is valid or not
                $row = mysqli_fetch_assoc($res);
                
                // Get individual values for selected Product
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_category = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];

                }else{
                    // Redirect to manage product page
                    $_SESSION['no-[product]-found'] = "<div class='error'>Product Not Found.</div>";
                    header("location:".SITEURL."admin/manage-product.php");

                }
            
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="num" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != ""){
                                // Display the image if available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/products/<?php echo $current_image; ?>" width="100px">
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
                    <td>Cateogry: </td>
                    <td><select name="category">
                        <?php
                            // Display current category from database
                            // Display all current active categories
                            $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                            
                            // Execute Query
                            $res2 = mysqli_query($conn, $sql2);

                            // Count rows to check whether there's category
                            $count = mysqli_num_rows($res2);

                            // if count is greater than 0 then there's category, else no
                            if($count > 0){
                                // We have categories
                                while($row2 = mysqli_fetch_assoc($res2)){
                                    // Get all details
                                    $category_title = $row2['title'];
                                    $category_id = $row2['id'];

                                    ?>
                                    <option <?php if($current_category==$category_id){echo "Selected";}?> value="<?php echo $category_id; ?>"> <?php echo $category_title; ?></option>
                                    <?php
                                }
                            }else{
                                // there's no categories
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }            
                        ?>
                    </td>
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
                        <input type="submit" name="submit" value="Update Product" class="btn-secondary">
                    </td>
                </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['submit'])){
                    // Get all the values from the form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

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
                            $image_name = "Product-".rand(000,999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/product/".$image_name;

                            // Upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);
                        
                            // Check whether the image is uploaded or not
                            // And if the image is not uploaded then we will stop the process and redirect with error message

                            if($upload == false){
                                // Set message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            
                                // Redirect to Add Product page
                                header("location:".SITEURL."admin/add-product.php");

                                // Stop the process
                                die();
                            }

                            // Remove the CURRENT image if available
                            if($current_image != ""){
                                $remove_path = "../images/product/".$current_image;
                                $remove = unlink($remove_path);

                                // Check whether the image is removed or not
                                // If failed to remove then display message and stop the process
                                if($remove == false){
                                    // Failed to remove image
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image.</div>";
                                    header("location:".SITEURL."admin/manage-product.php");

                                    // Stop the process
                                    die();
                                }
                            }
                        }else{
                            $image_name = $current_image; // Default Image when Image is not selected to be update
                        }
                    }else{
                        $image_name = $current_image; // Default image when button is not clicked
                    }

                    // Update the database
                    $sql3 = "UPDATE tbl_product SET
                                    title = '$title',
                                    description = '$description',
                                    image_name = '$image_name',
                                    category_id = '$category',
                                    featured = '$featured',
                                    active = '$active'
                            WHERE id=$id
                            ";
                    
                    // Execute the query
                    $res3=mysqli_query($conn,$sql3);

                    // Redirect  to manage product page
                    // Check if the query executed
                    if($res3==true){
                        //Successful update product
                        $_SESSION['update'] = "<div class='success'>Product Update Successfully.</div>";
                        header("location:".SITEURL."admin/manage-product.php");
                    }else{
                        //Successful update product
                        $_SESSION['update'] = "<div class='error'>Failed to Update Product.</div>";
                        header("location:".SITEURL."admin/manage-product.php");
                    }

                }
            ?>

    </div>
</div>

<?php include("partials/footer.php"); ?>
