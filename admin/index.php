<?php include('partials/menu.php'); ?>

    <!-- Main Section Starts -->
    <div class="main-section">
        <div class="wrapper">
            <h1>DASHBOARD</h1>
            <br>

            <?php
                if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']); //removing session message
                    }
            ?>

            <br><br>

            <div class="col-4">
                <?php 
                    $sql = "SELECT * FROM tbl_dessert";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>

                <h1><?php echo $count; ?></h1>
                </br>
                Desserts
            </div>
            <div class="col-4">
                <?php 
                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>

                <h1><?php echo $count; ?></h1>
                </br>
                Categories
            </div>
            <div class="col-4">
                <?php 
                    $sql = "SELECT * FROM tbl_orders";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>

                <h1><?php echo $count; ?></h1>
                </br>
                Orders
            </div>
            <div class="col-4">
                <?php 
                    $sql = "SELECT SUM(total) AS Total FROM tbl_orders";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);

                    $total = $row['Total'];
                ?>

                <h1><?php echo $total; ?>$</h1>
                </br>
                Total Revenue
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

</body>
</html>