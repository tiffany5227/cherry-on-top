<?php 
    include('../config/constants.php');

    //check whether id and img is set or not
    if(isset($_GET['id']) AND isset($_GET['img'])){
        //Get category ID and img
        $id = $_GET['id'];
        $img = $_GET['img'];

        //remove physical img file
        if($img != ""){
            $path = "../images/category/".$img;

            //remove img
            $remove = unlink($path);

            if($remove == false){
                //error msg and stop process
                $_SESSION['remove-img'] = "<div class='error-message'>Failed to delete category image</div>";
                header('location:'.SITEURL.'admin/categories.php');
                die();
            }
        }

        //SQL Query to delete admin
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute query
        $res = mysqli_query($conn, $sql);

        //Check if query executed successfully
        if ($res==TRUE){    
            //create session variable
            $_SESSION['delete'] = "Category deleted successfully!";
            header('location:'.SITEURL.'admin/categories.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error-message'>Failed to delete category</div>";
            header('location:'.SITEURL.'admin/categories.php');
        }

    }
    else{
        header('location:'.SITEURL.'admin/categories.php');
    }

?>