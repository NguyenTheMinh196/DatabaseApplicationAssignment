<?php
session_start();
require_once('config_mongodb.php');
require_once('config_sql.php');
$seller_id = $_SESSION['user'];

$product_sql = $sql->prepare('INSERT INTO product(name, price, closingtime, sellerid, bidplaced, status) VALUES(?, ?, ?, ?, 0, "not sold")');

if(isset($_POST['sell'])){
    $name=$_POST['name'];
    $price=$_POST['minimum_price'];
    $date=$_POST['closing_date'];
    $hour = $_POST['closing_hour'];
    $minute = $_POST['closing_minute'];
    $closing_time_string = $date."T".$hour.":".$minute;
    print_r($closing_time_string);
    $timestamp= strtotime($closing_time_string);
    $closing_time = date('Y-m-d H:i:s', $timestamp); 
    $product_sql->execute([$name, $price, $closing_time, $seller_id]);
    
    if(isset($_POST['key'])){
        $last_id = $sql->LastInsertId();
        $count = count($_POST['key']);
        $document = array();
        $document['_id'] = $last_id;
        for($x = 0; $x <= $count-1; $x++){
            $document[$_POST['key'][$x]] = $_POST['value'][$x];
        }
        print_r($document);
        $collection->insertOne( $document );
    }
}
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
                    <!-- <img src="/Users/ADMIN/Desktop/picture/-1591253249203679369585.jpg" width="105px"> -->
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
                <!-- <img src="/Users/ADMIN/Desktop/picture/pngtree-shopping-basket-line-icon-vector-png-image_1744039.jpg" width="30px" height="30px"> -->
            </div>
        </div>
    </div>
    <!-- sell the product part -->
    <div id = "boom">
        <form method="post" class = "input" id = "form">
            <h1 style = "text-align: center"> Sell product</h1>
            <label for = "product_name">Product Name:</label>
            <input type = "text" name = "name"  id = "product_name"> <br>
            <label for = "opening_price">Opening price:</label>
            <input type = "number" name = "minimum_price" id = "minimum_price"><br>
            <label for = "closing_date">Closing day:</label>
            <input type = "Date" name="closing_date" value = "<?php echo date("Y-m-d") ?>"id = "closing_date"><br>
            <label for = "closing_hour">Closing Hour:</label>
            <input type = "number" name = "closing_hour" value = "0" min = "0" max = "24"  id = "closing_hour"><br>
            <label for = "closing_minute">Closing minute:</label>
            <input type = "number" name = "closing_minute" value = "0" min = "0" max = "60"  id = "closing_minute"><br>

            <button onclick = 'createDiv(0)' type = 'button' id = 'currentbutton_0'> + </button>
            <input type = "submit" value = "Sell" name ="sell">
        </form>

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
    <script type = "text/javascript">
        function createDiv(current_attribute)
    {
    var container = document.getElementById('form');
    var Key = document.createElement('div');
    var Value = document.createElement('div');
    var next_button = document.createElement("div");
    var current_button = document.getElementById('currentbutton_' + current_attribute);
    current_button.style.display = "none";
    Key.innerHTML = "<label for = 'key[" + current_attribute + "]'> Name of additional attribute</label><input type = 'text' name = 'key[" + current_attribute + "]' value = 'Name: '>";
    Value.innerHTML = "<label for = 'value[" + current_attribute + "]'>Content: </label><input type = 'text' name = 'value[" + current_attribute + "]' value = 'Description'>";
    next_button.innerHTML = "<button onclick = 'createDiv("+ (parseInt(current_attribute) + 1) + ")' type = 'button' id = 'currentbutton_"+ (parseInt(current_attribute) + 1) + "'> + </button>";
    container.appendChild(Key);
    container.appendChild(Value);
    container.appendChild(next_button);
    }
    </script>
    
</html>