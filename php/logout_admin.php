<?php 
    include('config2.php');
    session_destroy();
    header('location:login_admin.php');
?>