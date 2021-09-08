<?php
session_start();
require '../vendor/autoload.php';
$conn = new MongoDB\Client("mongodb://localhost:27017"); // connects to localhost:27017
// select a database
$db = $conn->admin;
$collection = $db->products;
// $seller_id = $_SESSION['desd'];
$user_id = 2147483647; //currently using hardcode
$db_user = "root";
$db_pass = "";  
$db_name = "assignment";


$sqldb = new PDO('mysql:host=localhost;dbname=' . $db_name .';charset=utf8',$db_user, $db_pass);
$sqldb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$display = $sqldb->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
    FROM transaction T JOIN users U ON U.ID = T.sellerid
    JOIN users U1 ON U1.ID = T.buyerid
    WHERE T.sellerid="'.$user_id.'" OR T.buyerid="'.$user_id.'"');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Homepage</title>
  <!-- Link CSS -->
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/transaction.module.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
    <!-- start header -->
    <header>
        <div>
            <!--header  (Name of the market)-->
            <div class = "header"> 
                <div style = "justify-content: flex-start" class = "container">
                    <div class = "page_ava">
                        <img src = "../img/test_img.jpg" alt = "market_pic" class = "page_symbol">
                    </div>
                    <div class = "Name" style= "text-align: center">
                        <p style = "vertical: center">Name of the market</p>
                    </div>
                </div>
                <div>
                    <nav class = "menu">
                    <ul>
                        <a href = "#"><li> Home </li></a>
                        <a href = "#"><li> Sell product </li></a>
                        <a href = "#"><li> Account </li></a>
                    </ul>
                    </nav>
                </div>
                <div style = "justify-content: flex-end" class = "container">
                    <div id = "User_name">
                        <p><i class="fas fa-caret-down"></i> name</p>
                        <div class = "More_info_name">
                        <a href = "#">Account</a>
                        </div>
                    </div>
                    <div>
                        <img src = "../img/avatar-1.jpg" alt = "avatar" class = "profile_pic" >
                    </div>
                </div>
            </div>
            <!--Nav bar--> 
        </div>
    </header>
    <!-- end header -->
    <!-- start body -->
    <div class = "body">
        <div class = "Header">
            <h1>Transaction History: </h1>
        </div>
        <div class = "body_container">
        </div>
        <div class="toolbar">
        <form class = "search" method = "post">
        <label for = "closing_time">Start date:</label>
        <input type = "Date" name="start_date" value = "<?php echo date("Y-m-d") ?>"><br>
        <label for = "closing_time">End date:</label>    
        <input type = "Date" name="end_date" value = "<?php echo date("Y-m-d") ?>"><br>
                <button type="submit" name = "search" class = "submit_button"><i class="fa fa-search"></i></button>
        </form>
        
        </div>
        
            <div class = "market_section">
                <div class = "onetransaction">

                    <div class = "product_name section">                
                        Product's name
                    </div>
                    <div class = "seller section">
                        Seller
                    </div>
                    <div class = "buyer section">
                        Current buyer:
                    </div>
                    <div class = "closing_time section">
                        Closing time:
                    </div>
                    <div class = "current_highest_bid">
                        Price:
                    </div>
                    <div class = "status section">
                        Status:
                    </div>
            </div>
                <!-- product 1 -->
                <?php

                $data = $collection->find();
                foreach ($display as $row) {
                    echo('<div class = "onetransaction">');
                    echo('<div class = "product_name section product">');
                    echo($row['name']);
                    echo('</div>');
                    echo('<div class = "seller section product">');
                    echo($row['Seller']);
                    echo('</div>');
                    echo('<div class = "buyer section product">');
                    echo($row['Buyer']);
                    echo('</div>');
                    echo('<div class = "closing_time section product">');
                    echo($row['closingtime']);
                    echo('</div>');
                    echo('<div class = "current_highest_bid section product">');
                    echo($row['price']);
                    echo('</div>');
                    echo('<div class = "status section product">');
                    echo($row['status']);
                    echo('</div>');
                    echo('</div>');
                }?>
            
</body>
</script>
</html>

