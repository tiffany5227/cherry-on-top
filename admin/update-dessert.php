<?php 
    include('partials/menu.php'); 
    ob_start();
?>

<div class="main-section">
    <div class="wrapper">
        <h1>Update Dessert</h1>

        <br><br>

        <?php

            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_dessert WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1){
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_img = $row['img'];
                    $category = $row['category_id'];
                    $active = $row['active'];

                }
                else{
                    $_SESSION['no-dessert-found'] = "<div class='error-message'>Dessert not found</div>";
                    header('location:'.SITEURL.'admin/desserts.php');
                    die();
                }

            }
            else{
                header('location:'.SITEURL.'admin/desserts.php');
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
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_img != ""){
                                ?>
                                <img src="<?php echo SITEURL; ?>images/dessert/<?php echo $current_img; ?>" width="150px">
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
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                //get all active categories in db
                                $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res2 = mysqli_query($conn, $sql2);

                                $count = mysqli_num_rows($res2);

                                if($count > 0){
                                    while($row = mysqli_fetch_assoc($res2)){
                                        $category_id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option <?php if($category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }

                                }
                                else{
                                    //no categories available
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php

                                }
                            ?>
                        </select>
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
                        <input type="submit" name="submit" value="Update Dessert" class="btn-primary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                
                //get values from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_img = $_POST['current_img'];
                $category = $_POST['category'];
                $active = $_POST['active'];

                //update new img if selected
                if(isset($_FILES['img']['name'])){
                    $img = $_FILES['img']['name'];

                    //check if img is available or not
                    if($img != ""){
                        //get extension of img
                        $ext = end(explode('.', $img));

                        //rename
                        $img = "dessert".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['img']['tmp_name'];
                        $destination_path = "../images/dessert/".$img;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check if uploaded
                        if($upload==FALSE){
                            $_SESSION['upload'] = "<div class='error-message'>Failed to upload image</div>";
                            header("location:".SITEURL.'admin/desserts.php');

                            //stop process since we do not want to update db
                            die();
                        }

                        //remove current image if available
                        if($current_img != ""){
                            $remove_path = "../images/dessert/".$current_img;
                            $remove = unlink($remove_path);

                            //check if img is removed
                            if($remove==false){
                                $_SESSION['failed-remove'] - "<div class='error-message'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/desserts.php');
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
                $sql3 = "UPDATE tbl_dessert SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    img = '$img',
                    category_id = '$category',
                    active = '$active'
                    WHERE id = $id
                ";

                $res3 = mysqli_query($conn, $sql3);

                if($res3==true){
                    $_SESSION['update'] = "Dessert updated successfully!";
                    header('location:'.SITEURL.'admin/desserts.php');
                }
                else{
                    $_SESSION['update'] = "<div class='error-message'>Failed to update dessert</div>";
                    header('location:'.SITEURL.'admin/desserts.php');
                }

            }

            ob_end_flush();

        ?>

    </div>
</div>

</body>
</html>