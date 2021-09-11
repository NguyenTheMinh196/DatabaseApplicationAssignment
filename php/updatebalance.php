

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
    require_once('config_sql.php');
    $update = $sql->prepare('UPDATE users SET balance = ? WHERE ID = ?');
    $id = $_GET['user'];
    $getuser = $sql->query('SELECT U.firstname, U.username, U.phonenumber, U.email, U.ID, U.country, U.branch, U.balance FROM users U WHERE U.ID = '.$id);
   // get values form input text and number
   
   if(isset($_POST['update'])){
    $new_balance = $_POST['new_balance'];
    $status = $update->execute([$new_balance, $id]);
    $getuser = $sql->query('SELECT U.firstname, U.username, U.phonenumber, U.email, U.ID, U.country, U.branch, U.balance FROM users U WHERE U.ID = '.$id);
    echo('<div style = "position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border: 5px solid #FFFF00;
    padding: 10px;">
        You have updated the balance successfully
    </div>');
}

    
   // mysql query to Update data
//    $query = "UPDATE `users` SET `balance`='".$balance." WHERE `id` = $id";
   
//    $result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>

<html>

        <head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>update balance</title>

  <link rel="stylesheet" href="../css/style.css" />
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
                        <a href = "../index.php"><li> Home for user </li></a>
                        <a href = "admin.php"><li> Admin Home </li></a>
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
        <div>
            <h1>
                UPDATE BALANCE
            </h1>
        <?php
        $display = $getuser->fetch();
                    echo('<div>');
                    echo('Username:');
                    echo($display['username']);
                    echo('</div>');
                    echo('<div>');
                    echo("User's firstname:");
                    echo($display['firstname']);
                    echo('</div>');
                    echo('<div>');
                    echo('Phone number:');
                    echo($display['phonenumber']);
                    echo('</div>');
                    echo('<div>');
                    echo('Email:');
                    echo($display['email']);
                    echo('</div>');
                    echo('<div>');
                    echo('Country:');
                    echo($display['country']);
                    echo('</div>');
                    echo('<div>');
                    echo('Branch:');
                    echo($display['branch']);
                    echo('</div>');
                    echo('<div>');
                    echo('Current balance:');
                    echo($display['balance']);
                    echo('</div>');
                ?>
                <br>
                <br>
        <form method="post">
            Balance to Update:<input type="number" name="new_balance" min = "0" required><br><br>
            <input type="submit" name="update" value="Update balance"> 
        </form>

    </body>
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

</html>
 
					