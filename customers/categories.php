<?php include('partials/customer-menu.php'); ?>

<section class="main-section">
    <h1>Explore Categories</h1>

    <br><hr><br>

    <div class="menu-layout">
    <?php
        
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count > 0){
            while($row = mysqli_fetch_assoc($res)){

                $id = $row['id'];
                $title = $row['title'];
                $img = $row['img'];
                $active = $row['active'];
                ?>
                
                <div class="menu-item">
                    <a href="category-desserts.php?id=<?php echo $id; ?>&title=<?php echo $title; ?>">
                        <?php 
                            if($img == ""){
                                ?>
                                <img class="image" src="<?php echo SITEURL; ?>images/unavailable-image.jpg" alt='Unavailable Category Image'>
                                <?php
                            }
                            else{
                                ?>
                                <img class="image" src="<?php echo SITEURL; ?>images/category/<?php echo $img; ?>" alt='Category Image'>
                                <?php
                            }

                        ?>
                        <h2 style="color:darkred;"><?php echo $title; ?></h2>
                    </a>
                    
                </div>

                <?php 
            }
        }
        else{
            echo "<div class='error-message'>Category not found</div>";
        }

    ?>
    </div>
</section>

</body>
</html>