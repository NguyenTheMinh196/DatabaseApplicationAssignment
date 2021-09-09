<?php
session_start();
require_once('config_sql.php');
// select a database
// $seller_id = $_SESSION['desd'];
$seller_id = 2147483647; //currently using hardcode
$user_sql = $sql->query("SELECT * FROM users U ");
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
  </body>
</html>
<script>
  $(function () {
    $("#nav-placeholder").load("index.php");
  });
</script>
