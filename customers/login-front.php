<?php 
    include('../config/constants.php');
    ob_start(); 
?>
<html>  
    <head>
        <title>Login</title>
        <style>
        <?php include "../css/main.css" ?>
        </style>
    </head>
    <body style="background-color: whitesmoke;">
        <div id="login-box" class="center-white-box">
            <h1>Login</h1>
            <div>
                <?php
                    if(isset($_SESSION['login'])){
                            echo $_SESSION['login'];
                            unset($_SESSION['login']); //removing session message
                    }

                    if(isset($_SESSION['no-login-message'])){
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']); //removing session message
                    }

                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); //removing session message
                    }

                ?>
            </div>

            <br>

            <form style="text-align:center;" action="" method="POST">
            Email: <br>
            <input type="text" name="email" placeholder="Enter email">
            <br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter password">
            <br><br>

            <input type="submit" name="submit" value="Log In" class="btn-primary">
            </form>

        </div>
        <div id="signup-admin">
            <div id="sign-up"><a href="signup.php">Create an account</a></div>
            <div id="go-to-admin">
                <a href="../admin/login-admin.php">I am an admin</a>
            </div>
            
        </div>

    </body>
</html>

<?php 
        //check whether if submit button is clicked
        if(isset($_POST['submit'])){

            //get values from form
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            //SQL Query to find admin
            $sql = "SELECT * FROM tbl_users WHERE email='$email' AND password='$password'";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //count rows to check whether user exists or not
            $count = mysqli_num_rows($res);

            if($count == 1){
                $_SESSION['login'] = "Login successful!";

                $row = mysqli_fetch_assoc($res);
                $id = $row['id'];
                $full_name = $row['full_name'];
                $_SESSION['user-id'] = $id; //to check whether the user is logged in
                $_SESSION['user-fullname'] = $full_name;

                header('location:'.SITEURL.'customers/index.php?id='.$id);

            }
            else{
                $_SESSION['login'] = "<div class='text-center error-message'>Email or Password did not match</div>";
                header('location:'.SITEURL.'customers/login-front.php');
            }
            
        }
        ob_end_flush();

    ?>