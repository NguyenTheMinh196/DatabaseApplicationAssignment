<?php include('config_sql.php'); ?>
<?php
session_start();
    if(!isset($_SESSION['user']))
    {
       $_SESSION['no-login-message']="Please log in to access Menu ";
       header('location:php/login.php');
    }
?>