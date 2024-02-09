<?php 
    include('../config/constants.php');

    //Get admin ID
    $id = $_GET['id'];

    //SQL Query to delete admin
    $sql = "DELETE FROM tbl_orders WHERE id=$id";

    //Execute query
    $res = mysqli_query($conn, $sql);

    //Check if query executed successfully
    if ($res==TRUE){    
        //create session variable
        $_SESSION['delete'] = "Order deleted successfully!";
        header('location:'.SITEURL.'admin/orders.php');
    }
    else{
        $_SESSION['delete'] = "<div class='error-message'>Failed to delete order</div>";
        header('location:'.SITEURL.'admin/orders.php');
    }
?>