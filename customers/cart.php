<?php 
    ob_start();
    include('partials/customer-menu.php');

    //if user removed an item from their cart, remove it
    if(isset($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])){
        unset($_SESSION['cart'][$_GET['remove']]);
    }

?>

<div id="cart-box" class="center-white-box">
    <h1>Your Cart</h1>
    <div class="product-section">
        <table class="tbl-items" width="100%">
            <tr>
                <th colspan="2" style="text-align:left">Items</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
            <?php
                if (!isset($_SESSION['cart'])){
                    echo "<tr><td colspan='5'>No items in your cart</td></tr>";
                }
                else{
                    $subtotal = 0;
                    foreach ($_SESSION['cart'] as $id => $qty){
                        $sql = "SELECT * FROM tbl_dessert WHERE id=$id";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        
                        if($count == 1){
                            $row = mysqli_fetch_assoc($res);

                            $img = $row['img'];
                            $title = $row['title'];
                            $price = $row['price'];

                            $subtotal += $price*$qty;
                            ?>
                            <tr>
                                <td class="cart-img-section">
                                    <?php
                                        if ($img!=""){
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/dessert/<?php echo $img; ?>">
                                            <?php

                                        }
                                        else{
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/unavailable-image.jpg" alt='Unavailable Dessert Image'>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $title; ?>
                                    <div class="remove"><a href="cart.php?remove=<?php echo $id; ?>">Remove</a></div>
                                </td>
                                <td><?php echo $price; ?>$</td>
                                <td>
                                    <form method="POST" width="50%">
                                        <input style="width: 10%;" type="number" min="1" name="qty" value="<?php echo $qty; ?>">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="submit" name="update" value="Update">
                                    </form>
                                    <?php 
                                        if(isset($_POST['update'])){
                                            $id = $_POST['id'];
                                            $qty = $_POST['qty'];

                                            $_SESSION['cart'][$id] = $qty;
                                            header("Refresh:0");
                                        }
                                    ?>
                                </td>

                                <td style="font-weight: bold;">
                                    <?php echo number_format((float)$price*$qty, 2, '.', ''); ?>$
                                </td>
                            </tr>

                            <?php

                        }
                        
                    }
                    
                    ?>
                    <div>
                        <table class="tbl-total">
                            <tr>
                                <td colspan="4">Subtotal:</td>
                                <td><?php echo number_format((float)$subtotal, 2, '.', '');; ?>$</td>
                            </tr>
                            <tr>
                                <td  colspan="4">Taxes (15%):</td>
                                <td><?php echo number_format((float)$subtotal*0.15, 2, '.', '');; ?>$</td>
                            </tr>
                            <tr style="font-weight: bold;">
                                <td colspan="4">Grand total:</td>
                                
                                <td>
                                    <?php 
                                        $total = $subtotal+ ($subtotal*0.15);
                                        echo number_format((float)$total, 2, '.', '');; 
                                    ?>
                                        $
                                </td>
                            </tr>
                        </table>

                        <br>
                        
                        <div id="place-order">
                            <form action="confirm-order.php" method="POST">
                                <input type="hidden" name="total" value="<?php echo $total; ?>">
                                <input type="submit" name="place-order" value="Place Order" class="btn-primary">
                            </form>
                        </div>
                    </div>
                    <?php
                }
                
                ob_end_flush();
            ?>
        </table>

    </div>
</div>