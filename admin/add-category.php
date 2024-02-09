<?php 
    include('partials/menu.php'); 
    ob_start();
?>

<div class="main-section">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>

        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']); //removing session message
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']); //removing session message
            }
        ?>
        </br></br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-admin">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Enter category name"></td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="img"></td>
                </tr>
                
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    //Process value form and save it in db

    //Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){

        //get title from form
        $title = $_POST['title'];

        //get radio options 
        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }
        else{
            $active = "No";
        }

        //check whether an img file is selected or not
        if(isset($_FILES['img']['name'])){
            //Upload the img
            $img = $_FILES['img']['name'];

            //upload img onlly if img is selected
            if($img != ""){
                //rename img to avoid automatic renaming when uploading same images
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
                    header("location:".SITEURL.'admin/add-category.php');

                    //stop process since we do not want to update db
                    die();
                }

            }
            
        }
        else{
            $img = "";
        }

        //SQL Query to save data into db
        $sql = "INSERT INTO tbl_category SET
            title = '$title',
            img = '$img',
            active = '$active'
            ";

        //Execute Query and save data in db
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check whether data is inserted or not and display appropriate message
        if($res == TRUE){
            //create a session variable to display message
            $_SESSION['add'] = "Category added successfully!";

            //redirect page 
            header("location:".SITEURL.'admin/categories.php');
        }
        else{
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error-message'>Failed to add category</div>";

            //redirect page 
            header("location:".SITEURL.'admin/categories.php');
        }

    }

    ob_end_flush();

?>

</body>
</html>