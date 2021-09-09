<?php 
    include('config_sql.php');
    session_destroy();
    header('location:'.SITEURL.'login_admin.php');
?>