<?php 
    include('../config/constants.php');
    
    $id = $_SESSION['user-id'];

    $sql = "SELECT * FROM tbl_users WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

        if($count == 1){
            $row = mysqli_fetch_assoc($res);

            $full_name = $row['full_name'];
            $email = $row['email'];
        }
?>

<html>
    <head>
        <title>User Profile Page</title>
        <style>
        <?php 
            include ("../css/buttons.css");
            include ("../css/main.css"); 
        ?>
        </style>
    </head>
    <body style="background-color: whitesmoke;">
        <div id="profile-box" class="center-white-box">
            <h1>Profile</h1>

            <br>

            <div>
                <?php
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']); //removing session message
                    }

                    if(isset($_SESSION['pass-not-match'])){
                        echo $_SESSION['pass-not-match'];
                        unset($_SESSION['pass-not-match']); //removing session message
                    }

                    if(isset($_SESSION['password-changed'])){
                        echo $_SESSION['password-changed'];
                        unset($_SESSION['password-changed']); //removing session message
                    }

                ?>
            </div>
            <br>
            <div id="profile-section">
                <table width="100%">
                    <tr>
                        <td>Full Name:</td>
                        <td><?php echo $full_name; ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $email; ?></td>
                    </tr>
                </table>
                <br><br><br><br>
                <div id="profile-btns">
                    <a href="change-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                    <a href="order-history.php?id=<?php echo $id; ?>" class="btn-secondary">Order History</a>
                    <a href="sign-out.php" class="btn-danger">Sign out</a>
                </div>

            </div>
        </div>
        <div id="back-to-front"><a href="<?php echo SITEURL; ?>customers/index.php">Back to website</a></div>

    </body>
    
</html>