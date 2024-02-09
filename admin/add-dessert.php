<?php 
    include('partials/menu.php'); 
    ob_start();
?>

<div class="main-section">
    <div class="wrapper">
        <h1>Add Dessert</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']); //removing session message
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-admin">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter dessert title">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Add description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Image: </td>
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
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count > 0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Dessert" class="btn-primary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                //get data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }
                
                //upload img if selected
                if(isset($_FILES['img']['name'])){
                    //Upload the img
                    $img = $_FILES['img']['name'];
        
                    //upload img onlly if img is selected
                    if($img != ""){
                        //rename img to avoid automatic renaming when uploading same images
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
                            header("location:".SITEURL.'admin/add-dessert.php');
        
                            //stop process since we do not want to update db
                            die();
                        }
        
                    }
                    
                }
                else{
                    $img = "";
                }

                //insert into db
                $sql2 = "INSERT INTO tbl_dessert SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    img = '$img',
                    category_id = '$category',
                    active = '$active'
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true){
                    $_SESSION['add'] = "Dessert added successfully!";
                    header('location:'.SITEURL.'admin/desserts.php');
                }
                else{
                    $_SESSION['add'] = "<div class='error-message'>Failed to add dessert</div>";
                    header('location:'.SITEURL.'admin/desserts.php');
                }
            }
            
            ob_end_flush();

        ?>
    </div>
</div>

</body>
</html>