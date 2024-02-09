<?php 
    include('../config/constants.php'); 
    include('login-check.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        <?php 
            include("../css/buttons.css");
            include ("../css/admin-menu.css");
            include ("../css/admin.css"); 
        ?>
    </style>
    <meta charset="UTF-8">
    <title>Admin Home</title>
</head>
<body>
    <!-- Menu Section Starts -->
    <div class="menu">
        <div class="wrapper">
            <ul>
                <li><a id="end-session" href="logout-admin.php"> < END SESSION</a></li>
                <li><a href="index.php">HOME</a></li>
                <li><a href="admin.php">ADMIN</a></li>
                <li><a href="desserts.php">DESSERTS</a></li>
                <li><a href="categories.php">CATEGORIES</a></li>
                <li><a href="orders.php">ORDERS</a></li>
            </ul>
        </div>
    </div>