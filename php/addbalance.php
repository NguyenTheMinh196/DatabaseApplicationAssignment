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

    $display = $sql->query('SELECT U.firstname, U.username, U.phonenumber, U.email, U.ID, U.country, U.branch FROM users U');

    if(isset($_POST['search'])){
        $username 		= $_POST['name_search'];
        $display = $sql->query('SELECT U.firstname, U.username, U.phonenumber, U.email, U.ID, U.country, U.branch FROM users U WHERE U.username LIKE "%'.$username.'%"');

    };
    if(isset($_POST['sort'])){
        $type 		= $_POST['sort_column_type'];
        $column_name 		= $_POST['sort_column_name'];
        if($column_name == "username"){
            $display = $sql->query('SELECT U.firstname, U.username, U.phonenumber, U.email, U.ID, U.country, U.branch FROM users U ORDER BY U.username '.$type.';');
        }
        elseif($column_name == "country"){
            $display = $sql->query('SELECT U.firstname, U.username, U.phonenumber, U.email, U.ID, U.country, U.branch FROM users U ORDER BY U.country '.$type.';');
        }
        elseif($column_name == "branch"){
            $display = $sql->query('SELECT U.firstname, U.username, U.phonenumber, U.email, U.ID, U.country, U.branch FROM users U ORDER BY U.branch '.$type.';');
        }
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
    <!-- end header -->
    <!-- start body -->
    <div class = "body">
        <div class = "Header">
            <h1>UPDATE BALANCE </h1>
        </div>
        <div class = "body_container">
            <div class = "tool_bar">
                <div>
                    <form class = "search" method = "post">
                        Search by Username:

                        <input type = "text" name = "name_search" placeholder = "Search"  class= "search_bar">
                        <button type="submit" name = "search" class = "submit_button"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <form class = "sort" method = "post">
                    <div class = "sort_container">
                    <!-- <div> -->
                        <label for = "sort_column_name"> Sort by :</label>
                        <select name = "sort_column_name" id = "sort_column_name" class = "get_sort"> 
                            <option value="username">username</option>
                            <option value="country">country</option>
                            <option value="branch">branch</option>
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
                <div class = "oneproduct" style = "grid-template-columns: 10% 20% 20% 25% 15% 10%">
                
                    <div class = "section">                
                        Username
                    </div>
                    <div class = "section">
                        user's firstname
                    </div>
                    <div class = "section">
                        phonenumber
                    </div>
                    <div class = "section">
                        email                   
                    </div>
                    <div class = "section">
                        country
                    </div>
                    <div class = "section">
                        branch
                    </div>
            </div>
                <!-- product 1 -->
                <?php

                foreach ($display as $row) {
                    echo('<a class = "link_to_prod" href = "updatebalance.php?user=' . $row["ID"] . '">');
                    echo('<div class = "oneproduct" style = "grid-template-columns: 10% 20% 20% 25% 15% 10%">');
                    echo('<div class = "section product">');
                    echo($row['username']);
                    echo('</div>');
                    echo('<div class = "section product">');
                    echo($row['firstname']);
                    echo('</div>');
                    echo('<div class = "section product">');
                    echo($row['phonenumber']);
                    echo('</div>');
                    echo('<div class = "section product">');
                    echo($row['email']);
                    echo('</div>');
                    echo('<div class = "section product">');
                    echo($row['country']);
                    echo('</div>');
                    echo('<div class = "section product">');
                    echo($row['branch']);
                    echo('</div>');
                    echo('</div>');
                    echo('</a>');
                }
                ?>

            </div> 
            
        </div>
    </div>
        <!-- end body -->
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
    <!-- end footer -->
</body>
</script>
</html>