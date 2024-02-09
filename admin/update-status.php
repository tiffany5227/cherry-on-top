<?php 
    ob_start();
    include('partials/menu.php'); 
    
    $id = $_GET['id'];

    $sql = "SELECT status FROM tbl_orders WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1){
        $row = mysqli_fetch_assoc($res);
        $status = $row['status'];
    }

?>
<div class="main-section">
    <div id="status-box" class="center-white-box">
        <h1 class="text-center">Change Status to:</h1>
        <br><br>

        <form action="" method="POST">
            <input <?php if($status=="PENDING"){echo "checked";} ?> type="radio" name="status" value="PENDING">PENDING
            <input <?php if($status=="READY"){echo "checked";} ?> type="radio" name="status" value="READY">READY
            <input <?php if($status=="COMPLETED"){echo "checked";} ?> type="radio" name="status" value="COMPLETED">COMPLETED
            <br><br>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" class="btn-primary">
        </form>

        <?php 
            if(isset($_POST['submit'])){

                //get values from form to update
                $id = $_POST['id'];
                $status = $_POST['status'];
    
                //SQL Query to update admin
                $sql2 = "UPDATE tbl_orders SET 
                status = '$status'
                WHERE id='$id'
                ";
    
                //Execute query
                $res2 = mysqli_query($conn, $sql2);
    
                //check if executed
                if($res2==true){
                    $_SESSION['update'] = "Status updated successfully!";
                    header('location:'.SITEURL.'admin/orders.php');
                }
                else{
                    $_SESSION['update'] = "<div class='error-message'>Failed to update status</div>";
                    header('location:'.SITEURL.'admin/orders.php');
                }
                
            }

            ob_end_flush();
        
        ?>
    </div>
</div>
