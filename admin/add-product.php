<?php
    include("partials/menu.php");
?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Product</h1>
            <br><br>


            <?php
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload']; // Display session message
                        unset($_SESSION['upload']); // Remove session message
                    }
            
            ?>

            <br><br>
            <!-- STARTS add category-->

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the Product"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of the product."></textarea></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="num" name="price"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Cateogry: </td>
                    <td><select name="category">
                        <?php
                            // Display current category from database
                            // Display all current active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            
                            // Execute Query
                            $res = mysqli_query($conn, $sql);

                            // Count rows to check whether there's category
                            $count = mysqli_num_rows($res);

                            // if count is greater than 0 then there's category, else no
                            if($count > 0){
                                // We have categories
                                while($row = mysqli_fetch_assoc($res)){
                                    // Get all details
                                    $id = $row["id"];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"> <?php echo $title; ?></option>
                                    <?php
                                }


                            }else{
                                // there's no categories
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }

                            // Display dropdown
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td><input type="radio" name="featured" value="Yes">Yes</td>
                    <td><input type="radio" name="featured" value="No">No</td>

                </tr>
                <tr>
                    <td>Active: </td>
                    <td><input type="radio" name="active" value="Yes">Yes</td>
                    <td><input type="radio" name="active" value="No">No</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                    </td>
                </tr>
                </table>
            </form>
            <!-- ENDS add category-->

            <?php
                if(isset($_POST["submit"])){
                    // Get Value from the category form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    // Need to check whether the radio is selected or not
                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }else{
                        $featured = 'No';
                    }
                    
                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }else{
                        $active = 'No';
                    }

                    // Check whether the image is selected or not and set the value for the image name accordingly
                    // print_r($_FILES['image']);
                    // die(); // Break the code here

                    if(isset($_FILES['image']['name'])){
                        // Upload the image
                        // To upload the image we need the image name, source path and destination path
                        $image_name = $_FILES['image']['name'];

                        // Upload the image only if the image is selected
                        if($image_name != ""){


                        // Auto Rename the uploaded image
                        // Get the extension of our image
                        $ext = end(explode('.', $image_name));

                        // Rename the image
                        $image_name = "Product-".rand(0000,9999).'.'.$ext;

                        $src = $_FILES['image']['tmp_name'];

                        $dst = "../images/products/".$image_name;

                        // Upload the image
                        $upload = move_uploaded_file($src, $dst);
                        
                        // Check whether the image is uploaded or not
                        // And if the image is not uploaded then we will stop the process and redirect with error message

                        if($upload == false){
                            // Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            
                            // Redirect to Add Category page
                            header("location:".SITEURL."admin/add-product.php");

                            // Stop the process
                            die();
                        }

                    }
                    }else{
                        // Dont upload the iamge and set the image name as blank value
                        $image_name = "";
                    }

                    // Only need to add quotation for strings, Numerical value no need
                    $sql2 = "INSERT INTO tbl_product SET
                            title = '$title',
                            description = '$description',
                            price = $price, 
                            image_name = '$image_name',
                            category_id = '$category',
                            featured = '$featured',
                            active = '$active'
                    ";

                    // Execure the query and save in database

                    $res2 = mysqli_query($conn, $sql2);

                    // Check whether the query is executed or not
                    if($res2 == true){
                        // Query Executed and Category added
                        $_SESSION['add'] = "<div class='success'>Product Added Successfully.</div>";
                        header("location:".SITEURL."admin/manage-product.php");
                    }else{
                        // Failed to add category
                        $_SESSION['add'] = "<div class='error'>Failed to add product.</div>";
                        header("location:".SITEURL."admin/add-product.php");
                    }
                }
            ?>


        </div>
    </div>



<?php
    include("partials/footer.php");
?>