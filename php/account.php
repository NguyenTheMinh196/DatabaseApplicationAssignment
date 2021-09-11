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
// select a database
$user = $_SESSION['user'];
$user_sql = $sql->query('SELECT * FROM users U WHERE ID = "'.$user.'"');
$user_data = $user_sql->fetch();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!--font links-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/style.css" />
    <!--font links-->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/account.module.css" />
    <title>Account page</title>
  </head>

  <div id="nav-placeholder"></div>
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
    <div class="form_container">
      <div class="form_fields">
        <h1>Personal Information</h1>
        <div  style = "text-align: left;"> 
        <?php
        echo ('<img src="data:image/jpeg;base64,'.base64_encode( $user_data['image'] ).'" style = "  vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 50%;"/>');
        ?>
        </div>
        <h2>Full Name:</h2>
        <p><?php
        echo ($user_data['lastname'] . ' ' . $user_data['firstname']);
        ?></p>
        <h2>Username:</h2>
        <p><?php
        echo ($user_data['username']);
        ?></p>
        <h2>Address:</h2>
        <p><?php
        echo ($user_data['address']);
        ?></p>
           <h2>Email:</h2>
           <p><?php
        echo ($user_data['email']);
        ?></p>
           <h2>Phone:</h2>
           <p><?php
        echo ($user_data['phonenumber']);
        ?></p>
           <h2>country</h2>
           <p><?php
        echo ($user_data['country']);
        ?></p>
         <h2>balance</h2>
         <p><?php
        echo ($user_data['balance']);
        ?></p>
      </div>
    </div>
<!-- footer -->
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
</html>
<script>
  $(function () {
    $("#nav-placeholder").load("index.php");
  });
</script>
