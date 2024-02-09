<?php include('partials/menu.php'); ?>

    <!-- Main Section Starts -->
    <div class="main-section">
        <div class="wrapper">
            <h1>Manage Desserts</h1>
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
                if(isset($_SESSION['remove-img'])){
                    echo $_SESSION['remove-img'];
                    unset($_SESSION['remove-img']); //removing session message
                }
                if(isset($_SESSION['no-dessert-found'])){
                    echo $_SESSION['no-dessert-found'];
                    unset($_SESSION['no-dessert-found']); //removing session message
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']); //removing session message
                }
                if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']); //removing session message
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']); //removing session message
                }
            ?>

            <br><br>
            <!-- Button to Add Amin -->
            <a href="<?php echo SITEURL; ?>admin/add-dessert.php" class="btn-primary">Add Dessert</a>
            </br>
            </br>
            </br>

            <table class="fullwidth">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM tbl_dessert";

                    $res = mysqli_query($conn, $sql);

                    $sn = 1;

                    if($res==true){
                        $count = mysqli_num_rows($res);

                        if($count > 0){
                            while($row=mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $img = $row['img'];
                                $active = $row['active'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td>
                                            <?php
                                                if ($img!=""){
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/dessert/<?php echo $img; ?>" width="100px">
                                                    <?php

                                                }
                                                else{
                                                    echo "<div class='error-message'>Image not added</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-dessert.php?id=<?php echo $id; ?>" class="btn-secondary">Update Dessert</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-dessert.php?id=<?php echo $id; ?>&img=<?php echo $img; ?>" class="btn-danger">Remove Dessert</a>
                                        </td>
                                    </tr>

                                <?php


                            }
                        }
                        else{
                            echo "<tr><td colspan='6' class='error-message'>Food not added yet</td></tr>";
                        }
                    }

                ?>
            </table>

        </div>
    </div>

</body>
</html>