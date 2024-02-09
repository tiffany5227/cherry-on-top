<?php include('partials/menu.php'); ?>

    <!-- Main Section Starts -->
    <div class="main-section">
        <div class="wrapper">
            <h1>Manage Orders</h1>
            <br>
            <?php 
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']); //removing session message
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']); //removing session message
                }
            ?>

            </br></br>

            <table class="fullwidth">
                <tr>
                    <th>Order #</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    $sql = "SELECT * FROM tbl_orders";

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
                                    <a href="<?php echo SITEURL; ?>admin/view-order.php?id=<?php echo $id; ?>" class="btn-primary">View Order</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-status.php?id=<?php echo $id; ?>&?status=<?php echo $status; ?>" class="btn-secondary">Update Status</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Remove</a>
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