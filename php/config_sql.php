<?php 
$db_user = "root";
$db_pass = "";
$db_name = "assignment";

$sql = new PDO('mysql:host=localhost;dbname=' . $db_name .';charset=utf8',$db_user, $db_pass);
$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id=2147483647;
?>