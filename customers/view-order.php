<?php 
    include('partials/customer-menu.php'); 
    
    $id = $_GET['id'];
?>
<div id="view-order-box" class="center-white-box">
    <h1 style="text-align: center;">Order #<?php echo $id; ?></h1>
    <div class="product-section">
    <table width="100%" class="tbl-items">
        <tr>
            <th colspan="2" style="text-align:left">Items</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php
            $sql = "SELECT * 
            FROM tbl_orderItem, tbl_dessert 
            WHERE tbl_orderItem.order_id = $id
            AND product_id=tbl_dessert.id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            
            if($count > 0){
                while($row = mysqli_fetch_assoc($res)){

                $img = $row['img'];
                $title = $row['title'];
                $qty = $row['qty'];
                $price = $row['price'];

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
                    </td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $price; ?>$</td>

                </tr>

                <?php
                }
            }
        ?>
        </div>

    </table>
</div>

