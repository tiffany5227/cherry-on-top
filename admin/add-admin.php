<?php include('partials/menu.php'); ?>
<div class="main-section">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']); //removing session message
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-admin">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your full name"></td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="email" placeholder="Enter your email"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="text" name="password" placeholder="Enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
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
        //Button clicked
        // echo "Button clicked";

        //get data from form
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']); //encrypt password with md5

        //SQL Query to save data into db
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            email = '$email',
            password = '$password'
            ";

        //Execute Query and save data in db
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Check whether data is inserted or not and display appropriate message
        if($res == TRUE){
            //create a session variable to display message
            $_SESSION['add'] = "Admin added successfully!";

            //redirect page 
            header("location:".SITEURL.'admin/admin.php');
        }
        else{
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error-message'>Failed to add admin</div>";

            //redirect page 
            header("location:".SITEURL.'admin/admin.php');
        }

    }

?>