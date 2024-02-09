<?php include('partials/menu.php');?>
    <div class="main-section">
        <div class="wrapper">
            <h1>Update Admin</h1>   

            <br><br>

            <?php 
                //Get Admin ID
                $id = $_GET['id'];

                //SQL Query to get admin details
                $sql = "SELECT * FROM tbl_admin where id=$id";

                //Execute query
                $res = mysqli_query($conn, $sql);

                //Check if successful
                if($res==TRUE){
                    //check whether data is available or not
                        $count = mysqli_num_rows($res);

                        //check if we have admin data or not
                        if($count == 1){
                            $row = mysqli_fetch_assoc($res);

                            $full_name = $row['full_name'];
                            $email = $row['email'];

                    }
                    else{
                        header('location:'.SITEURL.'admin/admin.php');
                    }
                }
                
            ?>

            <form action="" method="POST">
                <table class="tbl-admin">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                    </tr>

                    <tr>
                        <td>Email: </td>
                        <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-primary">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>

    <?php 
        //check whether if submit button is clicked
        if(isset($_POST['submit'])){

            //get values from form to update
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];

            //SQL Query to update admin
            $sql = "UPDATE tbl_admin SET 
            full_name = '$full_name', 
            email = '$email'
            WHERE id='$id'
            ";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //check if executed
            if($res==true){
                $_SESSION['update'] = "Admin updated successfully!";
                header('location:'.SITEURL.'admin/admin.php');
            }
            else{
                $_SESSION['update'] = "<div class='error-message'>Failed to update admin</div>";
                header('location:'.SITEURL.'admin/admin.php');
            }
            
        }

    ?>
</body>
</html>