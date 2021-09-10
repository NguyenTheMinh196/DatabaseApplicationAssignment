<?php 
    include('config2.php');
    unset($_SESSION['users']);
    session_destroy();
    header('location:login.php');
?>