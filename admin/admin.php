<?php include('partials/menu.php'); ?>

    <!-- Main Section Starts -->
    <div class="main-section">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            </br>

            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']); //removing session message
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']); //removing session message
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']); //removing session message
                }

                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']); //removing session message
                }

                if(isset($_SESSION['pass-not-match'])){
                    echo $_SESSION['pass-not-match'];
                    unset($_SESSION['pass-not-match']); //removing session message
                }

                if(isset($_SESSION['password-changed'])){
                    echo $_SESSION['password-changed'];
                    unset($_SESSION['password-changed']); //removing session message
                }
            ?>

            <br><br>

            <!-- Button to Add Amin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            </br></br></br>

            <table class="fullwidth">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    $sql = "SELECT * FROM tbl_admin";

                    $res = mysqli_query($conn, $sql);

                    $sn = 1; //variable to display as id in table
                    //Check whether the query is executed
                    if($res==TRUE){
                        //count rows
                        $count = mysqli_num_rows($res); //get all rows in db

                        if($count > 0){
                            //while there is data in db
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $email = $rows['email'];
                            ?>
                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $full_name ?></td>
                                <td><?php echo $email ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Remove Admin</a>
                                </td>
                            </tr>

                            <?php 
                            }
                        }
                          
                    else{
                        echo "<div class='error-message'>No Admin</div>";

                    }
                    }
                
                ?>
            </table>
        </div>
    </div>

</body>
</html>