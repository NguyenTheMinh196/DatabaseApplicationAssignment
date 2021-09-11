<?php require_once('config_sql.php'); ?>
<?php
session_start();
    if(!isset($_SESSION['user']))
    {
       $_SESSION['no-login-message']="Please log in to access Menu ";
       header('location:login.php');
    }
?>