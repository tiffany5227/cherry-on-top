<?php
    include('../config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        <?php
            include("../css/buttons.css");
            include("../css/customer-menu.css"); 
            include ("../css/main.css"); 
        ?>
    </style>
    <meta charset="UTF-8">
    <title>Cherry On Top</title>
</head>
<body>
    <header id="header-section">
        <div id="header">
            <a href="index.php"><img id="logo" src="../images/logo.jpg" alt="logo" width="250" height="125"/></a>
            <div id="login_cart">
                <div id="login">
                    <?php
                        if(!isset($_SESSION['user-id'])){
                            ?>
                            <a href="../customers/login-front.php">Log In</a>
                            <?php
                        }
                        else{
                            ?>
                            <a href='../customers/profile.php?id=<?php echo $_SESSION['user-id']; ?>'><?php echo $_SESSION['user-fullname']; ?></a>
                            <?php
                        }

                    ?>
                </div>
                <div id="cart">
                    <a href="../customers/cart.php">Cart</a>
                </div>
            </div>
        </div>
        <nav id="navbar">
            <a <?php if($_SERVER['PHP_SELF'] == '/cherry-on-top/customers/index.php'){ echo "style='border-bottom: 3px darkred solid;'";} ?> href="index.php">HOME</a>
            <a <?php if($_SERVER['PHP_SELF'] == '/cherry-on-top/customers/desserts.php'){ echo "style='border-bottom: 3px darkred solid;'";} ?> href="desserts.php">DESSERTS</a>
            <a <?php if($_SERVER['PHP_SELF'] == '/cherry-on-top/customers/categories.php'){ echo "style='border-bottom: 3px darkred solid;'";} ?> href="categories.php">CATEGORIES</a>
            <a <?php if($_SERVER['PHP_SELF'] == '/cherry-on-top/customers/contact.php'){ echo "style='border-bottom: 3px darkred solid;'";} ?> href="contact.php">CONTACT</a>
        </nav>

    </header>
    