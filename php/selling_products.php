<?php
session_start();
require_once('config_mongodb.php');
require_once('config_sql.php');
$seller_id = $_SESSION['user'];

$product_sql = $sql->prepare('INSERT INTO product(name, price, closingtime, sellerid, bidplaced, status) VALUES(?, ?, ?, ?, 0, "not sold")');

if(isset($_POST['sell'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
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
    <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sell products</title>
  <!-- Link CSS -->
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/index.module.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    </head>
    
    <body>
    <header>
        <div>
            <!--header  (Name of the market)-->
            <div class = "header"> 
                <div style = "justify-content: flex-start" class = "container">
                    <div class = "page_ava">
                        <img src="img/avatar-1.jpg" alt = "market_pic" class = "page_symbol">
                        </div>
                    <div class = "Name" style= "text-align: center">
                        <p style = "vertical: center">Name of the market</p>
                    </div>
                </div>
                <div>
                    <nav class = "menu">
                    <ul>
                        <a href = "/DatabaseApplicationAssignment/index.php"><li> Home </li></a>
                        <a href = "selling_products.php"><li> Sell product </li></a>
                        <a href = "account.php"><li> Account </li></a>
                        <a href="logout.php"><li>Log out</li></a>
                    </ul>
                    </nav>
                </div>
                <div style = "justify-content: flex-end" class = "container">
                    <div id = "User_name">
                        <p><i class="fas fa-caret-down"></i> name</p>
                        <div class = "More_info_name">
                        <a href = "php/account.php">Account</a>
                        <a href = "php/pastTransactions.php">Past transaction</a>
                        </div>
                    </div>
                
                </div>
            </div>
            <!--Nav bar--> 
        </div>
    </header>
    <!-- sell the product part -->
    <div id = "boom">
        <form method="post" class = "input" id = "form">
            <h1 style = "text-align: center"> Sell product</h1>
            <label for = "product_name">Product Name:</label>
            <input type = "text" name = "name"  id = "product_name"> <br>
            <label for = "opening_price">Opening price:</label>
            <input type = "number" name = "price" id = "price"><br>
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