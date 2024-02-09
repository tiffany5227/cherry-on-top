<?php include('partials/menu.php'); ?>

    <div class="main-section">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>

            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-admin">
                    <tr>
                        <td>Current Password: </td>
                        <td><input type="password" name="current-password" placeholder="Enter your current password"></td>
                    </tr>

                    <tr>
                        <td>New Password: </td>
                        <td><input type="password" name="new-password" placeholder="Enter your new password"></td>
                    </tr>

                    <tr>
                        <td>Confirm Password: </td>
                        <td><input type="password" name="re-new-password" placeholder="Re-enter your new password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input class="btn-primary" type="submit" name="submit" value="Change Password">
                        </td>
                    </tr>

                </table>
            </form>

        </div>
        
    </div>

    <?php
        //check whether submit btn is clicked
        if(isset($_POST['submit'])){

            //get values from form to update
            $id = $_POST['id'];
            $current_password = md5($_POST['current-password']);
            $new_password = md5($_POST['new-password']);
            $re_new_password = md5($_POST['re-new-password']);

            //check whether user with current ID and current password exists
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            //execute query
            $res = mysqli_query($conn, $sql);

            if ($res==TRUE){
                //check whether data is available or not
                $count = mysqli_num_rows($res);

                if ($count == 1){
                    //check whether new password and current match or not
                    if ($new_password == $re_new_password){
                        $sql2 = "UPDATE tbl_admin SET 
                        password = '$new_password'
                        WHERE id=$id
                        ";

                        //Execute query
                        $res = mysqli_query($conn, $sql2);

                        //check if executed
                        if($res==true){
                            $_SESSION['password-changed'] = "Password updated successfully!";
                            header('location:'.SITEURL.'admin/admin.php');
                        }
                        else{
                            $_SESSION['password-changed'] = "<div class='error-message'>Failed to update password</div>";
                            header('location:'.SITEURL.'admin/admin.php');
                        }

                    }
                    else{
                        $_SESSION['pass-not-match'] = "<div class='error-message'>Passwords did not match</div>";
                        header('location:'.SITEURL.'admin/admin.php');
                    }
                }
                else{
                    $_SESSION['user-not-found'] = "<div class='error-message'>User not found</div>";
                    header('location:'.SITEURL.'admin/admin.php');
                }
            }
            
        }

    ?>



</body>
</html>