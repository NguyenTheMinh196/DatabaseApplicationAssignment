<?php 
    include('config_sql.php');
    session_destroy();
    header('location:login_admin.php');
?>