<?php
require '../vendor/autoload.php';
$conn = new MongoDB\Client("mongodb://localhost:27017"); // connects to localhost:27017
// select a database
$db = $conn->admin;
$collection = $db->products;
$a=$_POST['name'];
$b=$_POST['minimum_price'];
$c=$_POST['closing_time'];
$d=$_POST['description'];
$document = array( 
    "name" => "$a",
    "minimum_price" => "$b",
    "closing_time"=>"$c" ,
    "description" => "$d"
);

$collection->insert($document);
echo "New product added!";
$conn->close();
?>