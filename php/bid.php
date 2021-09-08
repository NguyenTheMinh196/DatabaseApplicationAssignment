<?php
require '../vendor/autoload.php';
session_start();

   // connect to mongodb
   $connection = new MongoDB\Client("mongodb://localhost:27017"); // connects to localhost:27017
   // select a database
   $db = $connection->asm;
   $collection = $db->test;
   $db_user = "root";
   $db_pass = "";  
   $db_name = "assignment";
   // $user_id = $_SESSION['desd'];
    $user_id = 2147483647; //currently using hardcode

   $sqldb = new PDO('mysql:host=localhost;dbname=' . $db_name .';charset=utf8',$db_user, $db_pass);
   $sqldb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $id_product = $_GET["product"];

   if(isset($_POST['bid'])){
       try{
        $bidding_price 		= $_POST['bidding_price'];
        $sql = 'CALL bid('. (int)$user_id . ', '.(int)$id_product .', '.(int)$bidding_price.')';
        $bid = $sqldb->query($sql);
        $display = $sqldb->query('SELECT P.name, P.id, P.minimumprice, P.closingtime, P.bidplaced, U.firstname, U.balance FROM product P join users U on U.ID = P.sellerid WHERE P.id =  '.$id_product.';');
        $product_data = $display->fetch();
        echo('<div style = "position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border: 5px solid #FFFF00;
    padding: 10px;">
        You have bid for the the product successfully
    </div>');
       }
       catch(PDOException $e){
        die("Error occurred:" . $e->getMessage());
       }
}
    else{
    $display = $sqldb->query('SELECT P.name, P.id, P.minimumprice, P.closingtime, P.bidplaced, U.firstname, U.balance, P.buyerid FROM product P join users U on U.ID = P.sellerid WHERE P.id =  '.$id_product.';');
    $product_data = $display->fetch();
    }
    $user_info = $sqldb->query('SELECT balance FROM users WHERE ID = '.$user_id.';');
    $user_balance = $user_info->fetch();
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
                $data = $collection->findOne(array('_id' => (int)$product_data['id']));
            ?>
                <div class="col-2">
                    <?php
                    echo('<h1>' . $product_data['name'] . '</h1>');
                    echo('<h3>Seller name:</h3>');
                    echo($product_data['firstname']);
                    ?>
                </div>
                <div class="col-2">
                <?php
                    echo('<h3>Bid placed: </h3>');
                    if($product_data['bidplaced'] == null){
                        echo('0');
                    }
                    echo($product_data['bidplaced']);
                    echo('<h3>Closing time: </h3>');
                    echo($product_data["closingtime"]); //currently a string can turn to time using strtotime()

                    if($data != null){
                        foreach ($data as $key=>$value){
                                if($key != "_id"){
                                echo('<h3>' . $key .'</h3>');
                                echo($value);
                            }
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
            <?php
            echo('<h2>Minimum Bidding price:'.  $product_data['minimumprice'] . 'VND</h2>');
            ?>
            <form method = "post">
                <label for= "bidding_price"></label>
                <?php
                echo('<input type = "number" name = "bidding_price" min = "'. (int)$product_data['minimumprice'] + 1 .'" max = "'.$user_balance['balance'].'" id = "bidding_price">');
                ?>
                <input type = "submit" value = "bid" name = "bid">
                
            </form>
            
        </div>
        
    </div>
    </div>
    </body>
</html>