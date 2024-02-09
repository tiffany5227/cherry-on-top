<?php
    include('env.php');
    
    //start session
    session_start();
   
    //Create constants to store non repeating values
    define('SITEURL', 'http://localhost/cherry-on-top/');
    define('LOCALHOST', 'localhost'); 
    define('DB_USERNAME', 'root');
    define('DB_NAME', 'cherry-on-top');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //db connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //select db
?>