<?php 
    include('config2.php');
    session_destroy();
    header('location:'.SITEURL.'login_admin.php');




?>