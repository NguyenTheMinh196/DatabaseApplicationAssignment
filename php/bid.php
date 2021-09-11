<?php
require_once('config_mongodb.php');
require_once('logincheck.php');
if(!isset($_SESSION['user']))
{
   $_SESSION['no-login-message']="Please log in to access Menu ";
   header('location:login.php');
}
    $user = $_SESSION['user'];
    $getuser_ava = $sql->query('SELECT image from users WHERE ID = '.$user.'');
    $ava = $getuser_ava->fetch();


   $id_product = $_GET["product"];

   if(isset($_POST['bid'])){
       try{
        $bidding_price 		= $_POST['bidding_price'];
        $bid = $sql->query('CALL bid('. (int)$user . ', '.(int)$id_product .', '.(int)$bidding_price.')');
        $display = $sql->query('SELECT P.name, P.id, P.minimumprice, P.closingtime, P.bidplaced, U.firstname, U.balance FROM product P join users U on U.ID = P.sellerid WHERE P.id =  '.$id_product.';');
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
    $display = $sql->query('SELECT P.name, P.id, P.minimumprice, P.closingtime, P.bidplaced, U.firstname, U.balance, P.buyerid FROM product P join users U on U.ID = P.sellerid WHERE P.id =  '.$id_product.';');
    $product_data = $display->fetch();
    }
    $user_info = $sql->query('SELECT balance FROM users WHERE ID = '.$user.';');
    $user_balance = $user_info->fetch();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bidme - Online Bidding Platform</title>
        <link rel="stylesheet" href="../css/bid.module.css">
        <link rel="stylesheet" href = "../css/style.css">
    </head>
    
    <body>
        
    <!-- start header -->
    <header>
        <div>
            <!--header  (Name of the market)-->
            <div class = "header"> 
                <div style = "justify-content: flex-start" class = "container">
                    <div class = "page_ava">
                        <img src="../img/avatar-1.jpg" alt = "market_pic" class = "page_symbol">
                    </div>
                    <div class = "Name" style= "text-align: center">
                        <p style = "vertical: center">Name of the market</p>
                    </div>
                </div>
                <div>
                    <nav class = "menu">
                    <ul>
                        <a href = "../index.php"><li> Home </li></a>
                        <a href = "selling_products"><li> Sell product </li></a>
                        <a href = "account.php"><li> Account </li></a>
                        <a href="logout.php"><li>Log out</li></a>
                    </ul>
                    </nav>
                </div>
                <div style = "justify-content: flex-end" class = "container">
                    <div id = "User_name">
                        <p><i class="fas fa-caret-down"></i> name</p>
                        <div class = "More_info_name">
                        <a href = "account.php">Account</a>
                        <a href = "pastTransactions.php">Past transaction</a>
                        </div>
                    </div>
                    <div>
                    <?php
                        echo('<img src="data:image/jpeg;base64,'.base64_encode( $ava['image'] ).'"  alt = "avatar" class = "profile_pic">');
                    ?>
                    </div>
                </div>
            </div>
            <!--Nav bar--> 
        </div>
    </header>
        <div class="header1">
            <div class="container">
            
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