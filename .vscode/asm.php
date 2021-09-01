<?php
// use for reference
//create db name on mysql practical
//create table on mysql (id int, name varchar, price int)
//create db name test on mongodb. create collection test.
//change however you want. example code
require_once '../vendor/autoload.php';

$client = new MongoDB\Client('mongodb://localhost:27017');

$collection = $client->test->test;


$document = $collection->find([]);
    $db_user = "root";
    $db_pass = "";  
    $db_name = "practical";

    $sqldb = new PDO('mysql:host=localhost;dbname=' . $db_name .';charset=utf8',$db_user, $db_pass);
    $sqldb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $create = $sqldb->prepare('INSERT INTO product(id, name, price) VALUE(?, ?, ?) ');

    $id = 1;
    $name = "boom";
    $price = 150000;
    $create->execute([$id, $name, $price]);
    $attributes = ['4G' => 'true', '2SIM' => 'Yes', 'brand' => 'Nokia'];
    $res = $collection->insertOne(['_id' => $id, 'attributes' => $attributes]);
  /*  
foreach ($document as $one) {
    echo 'ID : ' . $one['_id'] . '<br>';
    echo 'Name : ' . $one['name'] . '<br>';
    foreach ($one['hobbies'] as $key => $val) {
      echo "$key : $val " . '<br>';
    }
    foreach ($one['job'] as $key => $val) {
      echo "$key : $val " . '<br>';
    }
    if (isset($one['new_attribute'])) {
      echo 'new_attribute : ' . $one['new_attribute'] . '<br>';
    }
    if (isset($one['new_attribute_123'])) {
      echo 'new_attribute_123 : ' . $one['new_attribute_123'] . '<br>';
    }
    
    echo '<hr>';
  }
  
  /*
  $res = $collection->insertOne([
    '_id' => '3',
    'name' => 'Dang 3',
    'hobbies' => ['Java 3', 'PHP 3', 'Database 3'],
    'job' => ['title' => 'Developer', 'place' => 'Google', 'from' => '2010' ]
  ]);
  var_dump($res);
  */
  
  /*
  $res = $collection->updateOne(
    ['_id' => '3'],
    [
      '$set' => [
        'name' => 'Dang 2',
        'hobbies' => ['Java 2', 'PHP 2', 'Database 2'],
        'job' => ['title' => 'Developer 2', 'place' => 'Google 2', 'from' => '2010 2'],
        'new_attribute_123' => 123
      ]
    ]
  );
  var_dump($res);
  */
    ?>
    