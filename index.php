<?php
require 'vendor/autoload.php';
   // connect to mongodb
   $connection = new MongoDB\Client("mongodb://localhost:27017"); // connects to localhost:27017
   // select a database
   $db = $connection->asm;
   $collection = $db->test;
   $db_user = "root";
    $db_pass = "";  
    $db_name = "assignment";

    $sqldb = new PDO('mysql:host=localhost;dbname=' . $db_name .';charset=utf8',$db_user, $db_pass);
    $sqldb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $display = $sqldb->query('SELECT P.name, P.id, P.minimumprice, P.closingtime, P.bidplaced, U.firstname FROM product P join users U on U.ID = P.sellerid WHERE P.status = 0;');

    if(isset($_POST['search'])){
        $product_name 		= $_POST['name_search'];
        $display = $sqldb->query('SELECT P.name, P.id, P.minimumprice, P.closingtime, P.bidplaced, U.firstname FROM product P join users U on U.ID = P.sellerid WHERE P.name Like "%' .$product_name . '%" AND P.status = 0;');

    };
    if(isset($_POST['sort'])){
        $type 		= $_POST['sort_column_type'];
        $column_name 		= $_POST['sort_column_name'];
        if($column_name == "closing_time"){
            $display = $sqldb->query('SELECT P.name, P.id, P.minimumprice, P.closingtime, P.bidplaced, U.firstname FROM product P join users U on U.ID = P.sellerid ORDER BY P.closingtime '.$type.' AND P.status = 0;');
        }
        elseif($column_name == "current_bid_price"){
            $display = $sqldb->query('SELECT P.name, P.id, P.minimumprice, P.closingtime, P.bidplaced, U.firstname FROM product P join users U on U.ID = P.sellerid ORDER BY P.minimumprice '.$type.' AND P.status = 0;');
        }
        elseif($column_name == "the_number_of_bids_placed"){
            $display = $sqldb->query('SELECT P.name, P.id, P.minimumprice, P.closingtime, P.bidplaced, U.firstname FROM product P join users U on U.ID = P.sellerid ORDER BY P.bidplaced '.$type.' AND P.status = 0;');

        }
    };
    
?>
<!DOCTYPE html>
<html lang="en">
<?php
if(isset($_POST['search'])){
    $transaction_start_date 	= $_POST['start_date'];
    $transaction_end_date 		= $_POST['end_date'];
    $display = $sqldb->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
    FROM transaction T JOIN users U ON U.ID = T.sellerid
    JOIN users U1 ON U1.ID = T.buyerid
    WHERE T.closingtime >= '.$transaction_start_date.' AND T.closingtime <='.$transaction_end_date.'');
    };
    if(isset($_POST['search'])){
        $transaction_start_date 	= $_POST['start_date'];
        $transaction_end_date 		= $_POST['end_date'];
        
        $display = $sqldb->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
        FROM transaction T JOIN users U ON U.ID = T.sellerid
        JOIN users U1 ON U1.ID = T.buyerid
        WHERE T.closingtime BETWEEN "$transaction_start_date" AND "$transaction_end_date"');
        };
?>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Homepage</title>
  <!-- Link CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/index.module.css" />
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
                        <img src = "img/test_img.jpg" alt = "market_pic" class = "page_symbol">
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
                        <a href = "#">Past transaction</a>
                        </div>
                    </div>
                    <div>
                        <img src = "img/avatar-1.jpg" alt = "avatar" class = "profile_pic" >
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
            <h1>Market </h1>
        </div>
        <div class = "body_container">
            <div class = "tool_bar">
                <form class = "search" method = "post">
                    <input type = "text" name = "name_search" placeholder = "Search"  class= "search_bar">
                    <button type="submit" name = "search" class = "submit_button"><i class="fa fa-search"></i></button>
                </form>
                <form class = "sort" method = "post">
                    <div class = "sort_container">
                    <!-- <div> -->
                        <label for = "sort_column_name"> Sort by :</label>
                        <select name = "sort_column_name" id = "sort_column_name" class = "get_sort"> 
                            <option value="closing_time">closing time</option>
                            <option value="current_bid_price">current bid price</option>
                            <option value="the_number_of_bids_placed">the number of bids placed</option>
                        </select>
                    <!-- </div> -->
                    <!-- <div> -->
                        <select name = "sort_column_type" id = "sort_column_type" class = "get_sort"> 
                            <option value="ASC">ascension</option>
                            <option value="DESC">descending</option>
                        </select>
                    <!-- </div> -->
                        <input type="submit" value="Go" class = "submit_button get_sort" name = "sort">
                </div>
            </form>
                
            </div>
        </div>
            <div class = "market_section">
                <div class = "oneproduct">
                
                    <div class = "product_name section">                
                        Product's name
                    </div>
                    <div class = "seller section">
                        Seller
                    </div>
                    <div class = "closing_time section">
                        Closing time
                    </div>
                    <div class = "current_highest_bid section">
                        Current highest bid
                    </div>
                    <div class = "number_of_bids section">
                        Number of bids
                    </div>
            </div>
                <!-- product 1 -->
                <?php

                $data = $collection->find();
                foreach ($display as $row) {
                    echo('<a class = "link_to_prod" href = "php/bid.php?product=' . $row["id"] . '">');
                    echo('<div class = "oneproduct">');
                    echo('<div class = "product_name section product">');
                    echo($row['name']);
                    echo('</div>');
                    echo('<div class = "seller section product">');
                    echo($row['firstname']);
                    echo('</div>');
                    echo('<div class = "closing_time section product">');
                    echo($row['closingtime']);
                    echo('</div>');
                    echo('<div class = "current_highest_bid section product">');
                    echo($row['minimumprice']);
                    echo('</div>');
                    echo('<div class = "number_of_bids section product">');
                    echo($row['bidplaced']);
                    echo('</div>');
                    echo('</div>');
                    echo('</a>');
                }
                //     }
                // foreach ($data as $product){
                //     echo('<div class = "oneproduct">');
                //     echo('<div class = "product_name section product">');
                //     echo($product->name);
                //     echo('</div>');
                //     echo('<div class = "seller section product">');
                //     echo($product->seller_id);
                //     echo('</div>');
                //     echo('<div class = "closing_time section product">');
                //     echo($product->closingDate->toDateTime()->format('Y/m/d'));
                //     echo('</div>');
                //     echo('<div class = "current_highest_bid section product">');
                //     echo($product->openingprice);
                //     echo('</div>');
                //     echo('<div class = "number_of_bids section product">');
                //     echo($product->number_of_bid);
                //     echo('</div>');
                //     echo('</div>');
                // }
                ?>
                <!-- product 2
                <div class = "product_name section product">
                    Product's name
                </div>
                <div class = "seller section product">
                    Seller
                </div>
                <div class = "closing_time section product">
                    Closing time
                </div>
                <div class = "current_highest_bid section product">
                    Current highest bid
                </div>
                <div class = "number_of_bids section product">
                    Number of bids
                </div> -->
            </div> 
            
        </div>
    </div>
        <!-- end body -->
    <!-- footer -->
    <footer>
        <!-- footer menu -->
        <div class = "footer_menu"> 
            <div class= "">
               <a href = "#">home</a>
            </div>
            <div>
                <a href = "#">account </a>
            </div>
            <div>
                <a href = "#">Sell product</a>
            </div>
        </div>
        <!-- footer social media section -->
        <div class = "social_media_section">
            <div class="social_buttons"> <a href=""><i class="fab fa-instagram circle-icon"></i></a> <a href=""><i class="fab fa-facebook circle-icon"></i></a> <a href=""><i class="fab fa-linkedin-in circle-icon"></i></a> <a href=""><i class="fab fa-twitter circle-icon"></i></a> </div>
        </div>
        <div style = "padding-top: 10px;">
            <img src = "img/test_img.jpg" alt = "market_pic" class = "page_symbol">
        </div>
        <div style = "border-left: 2px solid gray; text-align:center;padding-top: 10px;" >
            copyright by ...

        </div>
    </footer>
    <!-- end footer -->
</body>
</script>
</html>


// } {
//     "_id": 2,
//     "name": "Drone",
//     "seller_id": 2147483647,
//     "openingDate": {
//         "$date": "2011-08-26T11:22:33.111Z"
//     },
//     "closingDate": {
//         "$date": "2021-08-26T11:22:33.111Z"
//     },
//     "openingprice": 5000000,
//     "minimumprice": 12000000,
//     "status": "open"
// } {
//     "_id": 3,
//     "name": "Honeypot",
//     "seller_id": 12341245,
//     "openingDate": {
//         "$date": "2011-08-26T11:22:33.111Z"
//     },
//     "closingDate": {
//         "$date": "2021-08-26T11:22:33.111Z"
//     },
//     "openingprice": 150000,
//     "minimumprice": 320000,
//     "status": "open"
// } {
//     "_id": 4,
//     "name": "iphone",
//     "sellerid": 2147483647,
//     "openingDate": {
//         "$date": "2011-08-26T11:22:33.111Z"
//     },
//     "closingDate": {
//         "$date": "2021-08-23T11:22:33.111Z"
//     },
//     "openingprice": 100000000,
//     "closingprice": 154000000,
//     "status": "closed"
// }
// {
//     "_id": 1,
//     "name": "rolex",
//     "seller_id": 2147483647,
//     "buyer_id": 12341245,
//     "openingprice": 100000000,
//     "openingDate": {
//         "$date": "2011-08-26T11:22:33.111Z"
//     },
//     "closingDate": {
//         "$date": "2021-08-23T11:22:33.111Z"
//     },
//     "closingprice": 154000000,
//     "status": "closed"
// }
//$product->closingDate->toDateTime()->format('Y/m/d')