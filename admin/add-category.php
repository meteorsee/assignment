<?php
    include("partials/menu.php");
?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>


            <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add']; // Display session message
                        unset($_SESSION['add']); // Remove session message
                    }

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
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
                </table>
            </form>
            <!-- ENDS add category-->

            <?php
                if(isset($_POST["submit"])){
                    // Get Value from the category form
                    $title = $_POST['title'];

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
                        $image_name = "Product_Category_".rand(000,999).'.'.$ext;

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

                    }
                    }else{
                        // Dont upload the iamge and set the image name as blank value
                        $image_name = '';
                    }

                    $sql = "INSERT INTO tbl_category SET
                            title = '$title',
                            image_name = '$image_name',
                            featured = '$featured',
                            active = '$active'
                    ";

                    // Execure the query and save in database

                    $res = mysqli_query($conn, $sql);

                    // Check whether the query is executed or not
                    if($res == true){
                        // Query Executed and Category added
                        $_SESSION['add'] = "<div class='success'>Category Successfully Added.</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                    }else{
                        // Failed to add category
                        $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
                        header("location:".SITEURL."admin/add-category.php");
                    }
                }
            ?>


        </div>
    </div>



<?php
    include("partials/footer.php");
?>