<?php
require 'vendor/autoload.php';
   // connect to mongodb
   $connection = new MongoDB\Client("mongodb://localhost:27017"); // connects to localhost:27017
   echo "Connection to database successfully";
   // select a database
   $db = $connection->asm;
   $collection = $db->product;
   $document = array( 
    "title" => "MongoDB", 
    "description" => "database", 
    "likes" => 100,
    "url" => "http://www.tutorialspoint.com/mongodb/",
    "by" => "tutorials point"
 );   
 $collection->insert($document);
 echo "Document inserted successfully";
   echo "Database mydb selected";
   if($connection = new mongoClient()){
    echo "Connected Successfully";
 } 
?>