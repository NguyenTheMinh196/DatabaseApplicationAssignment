<?php
session_start();
require_once('config_mongodb.php');
require_once('config_sql.php');
$seller_id = $_SESSION['user'];

$product_sql = $sql->prepare('INSERT INTO product(name, minimumprice, closingtime, sellerid, bidplaced, status) VALUES(?, ?, ?, ?, 0, "not sold")');

if(isset($_POST['sell'])){
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
        $last_id = $sql->LastInsertId();
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