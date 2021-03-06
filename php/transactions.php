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
    $display = $sql->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
    FROM transaction T JOIN users U ON U.ID = T.sellerid
    JOIN users U1 ON U1.ID = T.buyerid
    WHERE T.status = "not sold" OR T.status = "canceled";');
   
    if(isset($_POST['search'])){
    $transaction_start_date 	= $_POST['start_date'];
    $transaction_end_date 		= $_POST['end_date'];
    
    $display = $sql->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
    FROM transaction T JOIN users U ON U.ID = T.sellerid
    JOIN users U1 ON U1.ID = T.buyerid
    WHERE T.status = 1 AND T.closingtime >= "'.$transaction_start_date.'" AND T.closingtime < "'.$transaction_end_date.'";');
    };
    if(isset($_POST['cancel'])){
        $id=$_POST['id'];
        $cancel = $sql->query('CALL refund("'. $id .'")');
        $display = $sql->query('SELECT T.id, T.name, T.price ,T.closingtime, U.firstname AS Seller, U1.firstname AS Buyer, T.status 
        FROM transaction T JOIN users U ON U.ID = T.sellerid
        JOIN users U1 ON U1.ID = T.buyerid;');
        };
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
                    <a href = "/DatabaseApplicationAssignment/index.php"><li> Home </li></a>
                        <a href = "admin.php"><li> Admin Home </li></a>                       
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
            <h1>Transaction </h1>
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
        <form class="cancel" method ="post">
            <label for ="transaction_id">Transaction id:</label>
            <input type="number" name="id" value=null>
            <button type="submit" name="cancel" class="submit_button">Cancel</button>
        </form>
        </div>
        
            <div class = "market_section">
                <div class = "onetransaction" style = "grid-template-columns: 5% 15% 15% 15% 15% 15% 15%">
                <div class = "transaction_id section">                
                        Transaction ID:
                    </div>  
                    <div class = "product_name section">                
                        Product's name
                    </div>
                    <div class = "seller section">
                        Seller:
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
                foreach ($display as $row) {
                    echo('<div class = "onetransaction" style = "grid-template-columns: 5% 15% 15% 15% 15% 15% 15%">');
                    echo('<div class = "transaction_id section product">');
                    echo($row['id']);
                    echo('</div>');
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

