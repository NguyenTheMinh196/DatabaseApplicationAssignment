<?php require_once('config_sql.php'); ?>
<?php
    if(!isset($_SESSION['user']))
    {
       $_SESSION['no-login-message']="Please log in to access Admin ";
       header('location:login_admin.php');

    }
?>