<?php
    ob_start();
    include('../customers/partials/customer-menu.php');

?>

<section class="main-section">
    <?php
        //when the user clicks on Add To Cart
        if(isset($_POST['add-to-cart'])){
            echo "reached";
            $id = $_POST['id'];
            $qty = isset($_POST['qty']) ? intval($_POST['qty']) : 1;

            //making sure it's a positive number
            $qty = max(1, $qty);
            
            if($_SESSION['cart']== NULL){
                $_SESSION['cart'] = array();
            }

            if(isset($_SESSION['cart'][$id])){
                $_SESSION['cart'][$id] = intval($_SESSION['cart'][$id]) + $qty;

            }
            else{
                $_SESSION['cart'][$id] = $qty;
            }

            $_SESSION['added'] = "Added to Cart Successfully!";
            header('location:'.SITEURL.'customers/desserts.php');
        }

        //When the user searches an item, display
        if(isset($_POST['search'])){
        //Get the Search Keyword
        $search = $_POST['search'];

        $sql = "SELECT * FROM tbl_dessert WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        $res = mysqli_query($conn, $sql);
    
        echo "
            <h1>Explore \"$search\"</h1>
            
            <br><hr><br>

            <div class='menu-layout'>";


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
                                <img src="<?php echo SITEURL; ?>images/unavailable-image.jpg" alt='Unavailable Category Image'>
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
                        <form action="" method="POST">
                            <table class="tbl-quantity">
                                <tr>
                                    <td>Qty: <input id="qty-input" type="number" min="0" name="qty"></td>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <td><input type="submit" name="add-to-cart" value="Add To Cart" class="btn-primary" id="add-cart">
                                </tr>
                            </table>
                        </form>
                        
                    </div>

                <?php 
            }
        }
        else{
            echo "<div class='error-message'>Dessert not found. Please search again with another word</div>";
        }
    }
    
    ob_end_flush();

    ?>
    </div>
</section>

</body>
</html>