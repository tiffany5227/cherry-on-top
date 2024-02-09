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
        <div id="signup-box" class="center-white-box">
            <h1>Sign up</h1>

            <?php 

                if(isset($_SESSION['incomplete'])){
                    echo $_SESSION['incomplete'];
                    unset($_SESSION['incomplete']); //removing session message
                }
                
            ?>

            <br>

            <form action="" method="POST">
            Full Name: <br>
            <input type="text" name="full_name" placeholder="Enter full name">
            <br><br>
            Email: <br>
            <input type="text" name="email" placeholder="Enter email">
            <br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter password">
            <br><br>

            <input type="submit" name="submit" value="Create Account" class="btn-primary">
            </form>
        </div>
    </body>
</html>

<?php
    if(isset($_POST['submit'])){
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']); //encrypt password with md5

        if($full_name== "" || $email == "" || $password == ""){
            $_SESSION['incomplete'] = "<div class='error-message'>Please enter all fields to create an account</div>";
            //redirect page 
            header("location:".SITEURL.'customers/signup.php');
        }
        else {
            //SQL Query to save data into db
            $sql = "INSERT INTO tbl_users SET
                full_name = '$full_name',
                email = '$email',
                password = '$password'
                ";
            
            $res = mysqli_query($conn, $sql) or die(mysqli_error());

            if($res == TRUE){
                //create a session variable to display message
                $_SESSION['add'] = "Account created successfully!";

                //redirect page 
                header("location:".SITEURL.'customers/login-front.php');
            }
            else{
                //create a session variable to display message
                $_SESSION['add'] = "<div class='error-message'>Failed to create account</div>";

                //redirect page 
                header("location:".SITEURL.'customers/login-front.php');
            }
        }

    }

    ob_end_flush();

?>