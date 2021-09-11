<?php 
    require_once('config_sql.php');
    unset($_SESSION['users']);
    session_destroy();
    header('location:login.php');
?>