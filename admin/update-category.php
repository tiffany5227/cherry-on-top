<?php 
    include('partials/menu.php'); 
    ob_start();
?>

<div class="main-section">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php

            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1){
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_img = $row['img'];
                    $active = $row['active'];

                }
                else{
                    $_SESSION['no-category-found'] = "<div class='error-message'>Category not found</div>";
                    header('location:'.SITEURL.'admin/categories.php');
                    die();
                }

            }
            else{
                header('location:'.SITEURL.'admin/categories.php');
                die();
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-admin">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_img != ""){
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_img; ?>" width="150px">
                                <?php

                            }
                            else{
                                echo "<div class='error-message'>Image not added</div>";
                            }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="img">
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_img" value="<?php echo $current_img; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php 
            if(isset($_POST['submit'])){
                
                //get values from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_img = $_POST['current_img'];
                $active = $_POST['active'];

                //update new img if selected
                if(isset($_FILES['img']['name'])){
                    $img = $_FILES['img']['name'];

                    //check if img is available or not
                    if($img != ""){
                        //get extension of img
                        $ext = end(explode('.', $img));

                        //rename
                        $img = "food_category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['img']['tmp_name'];
                        $destination_path = "../images/category/".$img;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check if uploaded
                        if($upload==FALSE){
                            $_SESSION['upload'] = "<div class='error-message'>Failed to upload image</div>";
                            header("location:".SITEURL.'admin/categories.php');

                            //stop process since we do not want to update db
                            die();
                        }

                        //remove current image if available
                        if($current_img != ""){
                            $remove_path = "../images/category/".$current_img;
                            $remove = unlink($remove_path);

                            //check if img is removed
                            if($remove==false){
                                $_SESSION['failed-remove'] - "<div class='error-message'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/categories.php');
                            } 
                        }
                        
                    }
                    else{
                        $img = $current_img;
                    }
                }
                else{
                    $img = $current_img;
                }

                //update db
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    img = '$img',
                    active = '$active'
                    WHERE id = $id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true){
                    $_SESSION['update'] = "Category updated successfully!";
                    header('location:'.SITEURL.'admin/categories.php');
                }
                else{
                    $_SESSION['update'] = "<div class='error-message'>Failed to update category</div>";
                    header('location:'.SITEURL.'admin/categories.php');
                }

            }

            ob_end_flush();
        
        ?>
</body>
</html>

