<?php
    ob_start();
    include('../customers/partials/customer-menu.php');

    if(!isset($_SESSION['user-id'])){
        $_SESSION['no-login-message'] = "<div class='text-center error-message'>Please log in to place an order!</div>";
        header('location:'.SITEURL.'customers/login-front.php');
        exit;
    }
    else{
        $customer_id = $_SESSION['user-id'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Enter the order into db
        $total = $_POST['total'];

        $sql = "INSERT INTO tbl_orders SET
        total = $total,
        customer_id = $customer_id
        ";

        $res = mysqli_query($conn, $sql);
        $order_id = mysqli_insert_id($conn);

        if($res == TRUE){
            //now enter each order item into db with the current order_id
            foreach ($_SESSION['cart'] as $id => $qty){
                $sql3 = "INSERT INTO tbl_orderItem SET
                order_id = $order_id, 
                product_id = $id, 
                qty = $qty
                ";

                $res3 = mysqli_query($conn, $sql3);
                if($res == true){
                    unset($_SESSION['cart']);
                }
                else{
                    echo "<div class='error-message'>Could not place order. Please try again later</div>";
                }
            }
        }
        else{
            echo "<div class='error-message'>Could not place order. Please try again</div>";
        }
    } 
     else{
        echo "Not from form";
     }

?>

<div class="center-white-box" style="text-align:center;">
    <h2>Thank you for your order!</h2>
    <br>
    <p>Your treats are being prepared! You will receive a call once the order is ready to picked up!</p>
    <br>
    <b>- The <i style="color:darkred;">Cherry on Top</i> Team</b>
    <br><br><br><br>
</div>

<?php ob_end_flush(); ?>