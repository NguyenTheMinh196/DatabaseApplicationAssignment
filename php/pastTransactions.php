<?php
require_once('logincheck.php');
if(!isset($_SESSION['user']))
{
   $_SESSION['no-login-message']="Please log in to access Menu ";
   header('location:login.php');
}
    $user = $_SESSION['user'];
    $getuser_ava = $sql->query('SELECT image from users WHERE ID = '.$user.'');
    $ava = $getuser_ava->fetch();

$soldproduct = $sql->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
    FROM transaction T JOIN users U ON U.ID = T.sellerid
    JOIN users U1 ON U1.ID = T.buyerid
    WHERE T.sellerid = "'.$user.'" AND (T.status = "sold" OR T.status = "canceled");');
$boughtproduct = $sql->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
    FROM transaction T JOIN users U ON U.ID = T.sellerid
    JOIN users U1 ON U1.ID = T.buyerid
    WHERE T.buyerid = "'.$user.'" AND (T.status = "sold" OR T.status = "canceled");');
$biddingproduct = $sql->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
    FROM transaction T JOIN users U ON U.ID = T.sellerid
    JOIN users U1 ON U1.ID = T.buyerid
    WHERE (T.buyerid = "'.$user.'") AND (T.status = "not sold");');
$sellingproduct = $sql->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
FROM transaction T JOIN users U ON U.ID = T.sellerid
JOIN users U1 ON U1.ID = T.buyerid
WHERE (T.sellerid ="'.$user.'") AND (T.status = "not sold");');

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
    <!-- end header -->
    <!-- start body -->
    <div class = "body">
        <div class = "Header">
            <h1>Transaction History: </h1>
        </div>
        <div class = "body_container">
        </div>

            
        <div class = "market_section">
            <h1 style = "text-align: center"> Bidding products: </h1>

                <div class = "onetransaction"  style = "grid-template-columns: 25% 15% 15% 25% 15% 05%">
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
                    <div class = "current_highest_bid section">
                        Price:
                    </div>
                    <div class = "status section">
                        Status:
                    </div>
                </div>
                <!-- product 1 -->
                <?php

                foreach ($biddingproduct as $row) {
                    echo('<div class = "onetransaction" style = "grid-template-columns: 25% 15% 15% 25% 15% 05%">');
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
            </div>
            <div class = "market_section">
            <h1 style = "text-align: center"> Selling products: </h1>

                <div class = "onetransaction"  style = "grid-template-columns: 25% 15% 15% 25% 15% 05%">
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
                    <div class = "current_highest_bid section">
                        Price:
                    </div>
                    <div class = "status section">
                        Status:
                    </div>
                </div>
                <!-- product 1 -->
                <?php

                foreach ($sellingproduct as $row) {
                    echo('<div class = "onetransaction" style = "grid-template-columns: 25% 15% 15% 25% 15% 05%">');
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
            </div>
            <div class = "market_section">
            <h1 style = "text-align: center"> Sold products: </h1>

                <div class = "onetransaction"  style = "grid-template-columns: 25% 15% 15% 25% 15% 05%">
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
                    <div class = "current_highest_bid section">
                        Price:
                    </div>
                    <div class = "status section">
                        Status:
                    </div>
                </div>
                <!-- product 1 -->
                <?php

                foreach ($soldproduct as $row) {
                    echo('<div class = "onetransaction" style = "grid-template-columns: 25% 15% 15% 25% 15% 05%">');
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
            </div>
            <div class = "market_section">
            <h1 style = "text-align: center"> Bought products: </h1>

                <div class = "onetransaction"  style = "grid-template-columns: 25% 15% 15% 25% 15% 05%">
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
                    <div class = "current_highest_bid section">
                        Price:
                    </div>
                    <div class = "status section">
                        Status:
                    </div>
                </div>
                <!-- product 1 -->
                <?php

                foreach ($boughtproduct as $row) {
                    echo('<div class = "onetransaction"  style = "grid-template-columns: 25% 15% 15% 25% 15% 05%">');
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
            </div>
    </div> 
    <footer>
        <!-- footer menu -->
        <div class = "footer_menu"> 
            <div class= "">
               <a href = "../index.php">home</a>
            </div>
            <div>
                <a href = "account.php">account </a>
            </div>
            <div>
                <a href = "selling_products.php">Sell product</a>
            </div>
        </div>
        <!-- footer social media section -->
        <div class = "social_media_section">
            <div class="social_buttons"> <a href=""><i class="fab fa-instagram circle-icon"></i></a> <a href=""><i class="fab fa-facebook circle-icon"></i></a> <a href=""><i class="fab fa-linkedin-in circle-icon"></i></a> <a href=""><i class="fab fa-twitter circle-icon"></i></a> </div>
        </div>
        <div style = "padding-top: 10px;">
            <img src = "../img/test_img.jpg" alt = "market_pic" class = "page_symbol">
        </div>
        <div style = "border-left: 2px solid gray; text-align:center;padding-top: 10px;" >
            copyright by ...

        </div>
    </footer>     
</body>
</script>
</html>

