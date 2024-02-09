<?php
    //Authorization - Access control
    //check whether if user is logged in or not
    if(!isset($_SESSION['user'])){
        $_SESSION['no-login-message'] = "<div class='text-center error-message'>Please log in to access Admin Panel</div>";
        header('location:'.SITEURL.'admin/login-admin.php');
    }
    

?>