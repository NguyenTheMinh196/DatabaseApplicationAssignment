<?php
session_start();
require '../vendor/autoload.php';
$conn = new MongoDB\Client("mongodb://localhost:27017"); // connects to localhost:27017
// select a database
$db = $conn->admin;
$collection = $db->products;
// $seller_id = $_SESSION['desd'];
$seller_id = 2147483647; //currently using hardcode
$db_user = "root";
$db_pass = "";  
$db_name = "assignment";


$sqldb = new PDO('mysql:host=localhost;dbname=' . $db_name .';charset=utf8',$db_user, $db_pass);
$sqldb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$product_sql = $sqldb->prepare("INSERT INTO product(name, minimumprice, closingtime, sellerid, bidplaced) VALUES(?, ?, ?, ?, 0)");

if(isset($_POST['name'])){
    $name=$_POST['name'];
    $price=$_POST['minimum_price'];
    $date=$_POST['closing_date'];
    $hour = $_POST['closing_hour'];
    $minute = $_POST['closing_minute'];
    $closing_time_string = $date."T".$hour.":".$minute;
    print_r($closing_time_string);
    $timestamp= strtotime($closing_time_string);
    $closing_time = date('Y-m-d H:i:s', $timestamp); 
    $product_sql->execute([$name, $price, $closing_time, $seller_id]);
    
    if(isset($_POST['key'])){
        $last_id = $sqldb->LastInsertId();
        $count = count($_POST['key']);
        $document = array();
        $document['_id'] = $last_id;
        for($x = 0; $x <= $count-1; $x++){
            $document[$_POST['key'][$x]] = $_POST['value'][$x];
        }
        print_r($document);
        $collection->insertOne( $document );
    }
}
echo "New product added!";
?>