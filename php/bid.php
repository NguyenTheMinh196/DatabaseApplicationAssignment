<?php
require '../vendor/autoload.php';
   // connect to mongodb
   $connection = new MongoDB\Client("mongodb://localhost:27017"); // connects to localhost:27017
   // select a database
   $db = $connection->asm;
   $collection = $db->test;
   $pdo = new PDO('mysql:host=localhost;dbname=assignment', '', '');
   $users = $pdo->query("SELECT ")
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bidme - Online Bidding Platform</title>
        <link rel="stylesheet" href="../css/bid.module.css">
    </head>
    
    <body>
        <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="/Users/ADMIN/Desktop/picture/-1591253249203679369585.jpg" width="105px">
                </div>
                <nav>
                    <ul>
                        <li><a href="">HOME</a></li>
                        <li><a href="">PRODUCTS</a></li>
                        <li><a href="">ABOUT</a></li>
                        <li><a href="">CONTACT</a></li>
                        <li><a href="">ACCOUNT</a></li>

                    </ul>
                </nav>
                <img src="../img/avatar-1.jpg" width="30px" height="30px">
            </div>
            <div class="row">
            <?php
                $data = $collection->find();
                foreach ($data as $product){
            ?>
                <div class="col-2">
                    <?php
                    echo('<h1>' . $product->name . '</h1>');
                    echo('<h3>Opening time:</h3>');
                    echo($product->openingprice);
                    ?>
                </div>
                <div class="col-2">
                <?php
                    echo('<h3>Seller: </h3>');
                    echo($product->seller_id);
                    echo('<h3>Current Status: </h3>');
                    echo($product->status);
                    echo('<h3>Closing time: </h3>');
                    echo($product->closingDate->toDateTime()->format('Y/m/d'));
                    echo('<h3>Opening price: </h3>');
                    echo($product->openingprice);
                    foreach($product as $key=>$value){
                        if($key != "seller_id" && $key != "status" && $key!= "_id" && $key != "openingDate" && $key != "closingDate" && $key!= "name")
                        echo('<h3>'. $key .'</h3>');
                        echo($value);
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="big-container">
        <div class="row">
        <div class="col-4">
            <h1>Bidding place</h1>
            <h2>Minimum Bidding price: 125$</h2>
            <form>
                <label for= "bidding_price"></label>
                <input type = "number" name = "bidding_price" min = "125" id = "bidding_price">
                <input type = "submit" value = "bid">
            </form>
            
        </div>
        
    </div>
    </div>
    </body>
</html>