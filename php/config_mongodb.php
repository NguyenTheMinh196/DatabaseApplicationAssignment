<?php 

require '../vendor/autoload.php';
   // connect to mongodb
   $connection = new MongoDB\Client("mongodb://localhost:27017"); // connects to localhost:27017
   // select a database
   $db = $connection->asm;
   $collection = $db->test;

?>