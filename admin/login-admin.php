<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Admin</title>
        <style>
        <?php include "../css/admin.css" ?>
        </style>
    </head>
    <body style="background-color: whitesmoke;">
        <div id="login-box" class="center-white-box">
            <h1>Admin Login</h1><br>

            <?php
                if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']); //removing session message
                }

                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']); //removing session message
                }

            ?>

            <br><br>

            <form action="" method="POST">
            Email: <br>
            <input type="text" name="email" placeholder="Enter email">
            <br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter password">
            <br><br>

            <input type="submit" name="submit" value="Log In" class="btn-primary">
            </form>

        </div>
        <div id="back-to-front"><a href="<?php echo SITEURL; ?>customers/index.php">Back to website</a></div>
    </body>
</html>

<?php 
        //check whether if submit button is clicked
        if(isset($_POST['submit'])){

            //get values from form
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            //SQL Query to find admin
            $sql = "SELECT * FROM tbl_admin WHERE email='$email' AND password='$password'";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //count rows to check whether user exists or not
            $count = mysqli_num_rows($res);

            if($count == 1){
                $_SESSION['login'] = "Login successful!";

                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $_SESSION['user'] = $id; //to check whether the user is logged in

                header('location:'.SITEURL.'admin/index.php');

            }
            else{
                $_SESSION['login'] = "<div class='text-center error-message'>Email or Password did not match</div>";
                header('location:'.SITEURL.'admin/login-admin.php');
            }
        }
            


    ?>