<?php
    include('../config/constants.php');

    //Destroy the session
    session_destroy(); //will also unset $_SESSION['user']

    //redirect to customer home page
    header('location:'.SITEURL.'customers/index.php');

?>