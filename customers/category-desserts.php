<?php 
    ob_start();
    include('partials/customer-menu.php'); 

    if(isset($_GET['id']) AND isset($_GET['title'])){
        $id = $_GET['id'];
        $title = $_GET['title'];
    }
?>

<section class="main-section">
    <h1>Explore <?php echo $title; ?></h1>

    <div style="text-align: center;" >
        <?php
            if(isset($_SESSION['added'])){
                echo $_SESSION['added'];
                unset($_SESSION['added']); //removing session message
            }

        ?>
    </div>

    <br><hr><br>

    <div class="menu-layout">
    <?php
        
        $sql = "SELECT * FROM tbl_dessert WHERE category_id=$id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count > 0){
            while($row = mysqli_fetch_assoc($res)){

                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $category_id = $row['category_id'];
                $img = $row['img'];
                $active = $row['active'];

                ?>
                
                <div class="menu-item">
                    <?php 
                        if($img == ""){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/unavailable-image.jpg" alt='Unavailable Dessert Image'>
                            <div class='description'><?php echo $description; ?></div>

                            <?php
                        }
                        else{
                            ?>
                                <img src="<?php echo SITEURL; ?>images/dessert/<?php echo $img; ?>" alt='Category Image'>
                                <div class='description'><?php echo $description; ?></div>
                            <?php 
                        }
                    ?>
                    <div>
                        <h3><?php echo $title; ?><br><?php echo $price; ?>$</h3>
                    </div>
                    <div class="ordering-section">
                            <form action="" method="POST">
                                <table class="tbl-quantity">
                                    <tr>
                                        <td>Qty:</td>
                                        <td><input type="number" min="0" name="qty"></td>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <td><input type="submit" name="add-to-cart" value="Add To Cart" class="btn-primary" id="add-cart">
                                    </tr>
                                </table>
                            </form>
                    </div>  
                </div>
                <?php   
            }

                    if(isset($_POST['add-to-cart'])){
                        $id = $_POST['id'];
                        $qty = isset($_POST['qty']) ? intval($_POST['qty']) : 1;

                        //making sure it's a positive number
                        $qty = max(1, $qty);
                        
                        if($_SESSION['cart']== NULL){
                            $_SESSION['cart'] = array();
                        }

                        if(isset($_SESSION['cart'][$id])){
                            $_SESSION['cart'][$id] = intval($_SESSION['cart'][$id]) + $qty;
                            // echo $_SESSION['cart'][$id];
                            // echo $qty;

                        }
                        else{
                            $_SESSION['cart'][$id] = $qty;
                        }

                        $_SESSION['added'] = "Added to Cart Successfully!";
                        header('location:'.SITEURL.'customers/desserts.php');
                    }
            
        }
        else{
            echo "<div class='error-message'>Dessert not found</div>";
        }

       ob_end_flush();

    ?>
    </div>
</section>

</body>
</html>