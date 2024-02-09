<?php 
    include('partials/customer-menu.php'); 

    $customer_id = $_SESSION['user-id'];
?>

    <!-- Main Section Starts -->
    <div id="order-history-box" class="center-white-box">
        <h1>Your Order History</h1>
        <div class="order-list">
            </br>

            <table width="100%">
                <tr>
                    <th>Order #</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    $sql = "SELECT * FROM tbl_orders WHERE customer_id=$customer_id";

                    $res = mysqli_query($conn, $sql);

                    //Check whether the query is executed
                    if($res==TRUE){
                        //count rows
                        $count = mysqli_num_rows($res); //get all rows in db

                        if($count > 0){
                            //while there is data in db
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $total = $rows['total'];
                                $order_date = $rows['order_date'];
                                $status = $rows['status'];
                            ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $total ?>$</td>
                                <td><?php echo $order_date ?></td>
                                <td><?php echo $status; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>customers/view-order.php?id=<?php echo $id; ?>" class="btn-primary">View Order</a>
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