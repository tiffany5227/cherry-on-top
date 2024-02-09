<?php include('partials/menu.php'); ?>

    <!-- Main Section Starts -->
    <div class="main-section">
        <div class="wrapper">
            <h1>Manage Categories</h1>
            <br>

            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']); //removing session message
                }
                if(isset($_SESSION['remove-img'])){
                    echo $_SESSION['remove-img'];
                    unset($_SESSION['remove-img']); //removing session message
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']); //removing session message
                }
                if(isset($_SESSION['no-category-found'])){
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']); //removing session message
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']); //removing session message
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']); //removing session message
                }
                if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']); //removing session message
                }
                
            ?>
            </br></br>

            <!-- Button to Add Amin -->
            <a href="<?php echo SITEURL ?>admin/add-category.php" class="btn-primary">Add Category</a>
            </br>
            </br>
            </br>


            <table class="fullwidth">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php

                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql);

                    $sn = 1;

                    if($res == TRUE){
                        $count = mysqli_num_rows($res);

                        if($count > 0){
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $img = $rows['img'];
                                $active = $rows['active'];

                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?> </td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            if ($img!=""){
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $img; ?>" width="100px">
                                                <?php

                                            }
                                            else{
                                                echo "<div class='error-message'>Image not added</div>";
                                            }
                                        ?>
                                    </td>
                                    
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&img=<?php echo $img; ?>" class="btn-danger">Remove Category</a>
                                    </td>
                                </tr>

                                <?php

                            }

                        }
                        else{
                            ?>

                            <tr>
                                <td colspan="6"><div class="error-message">No Category Added</div></td>
                            </tr>

                            <?php
                        }


                    }

                ?>

            </table>

        </div>
    </div>

</body>
</html>