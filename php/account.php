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
        <div  style = "text-align: left;"> <img src = "../img/avatar-1.jpg" alt = "avatar" class = "profile_pic" ></div>
        <h2>Full Name:</h2>
        <p><?php  echo $username ?></p>
        <h2>Password:</h2>
        <p> password</p>
        <h2>Address:</h2>
        <p>address</p>
           <h2>Email:</h2>
        <p></p>
           <h2>Phone:</h2>
        <p></p>
           <h2>password</h2>
        <p></p>
           <h2>country</h2>
        <p></p>
         <h2>branch</h2>
        <p></p>
         <h2>balance</h2>
        <p></p>
      </div>
    </div>
  </body>
</html>
<script>
  $(function () {
    $("#nav-placeholder").load("index.php");
  });
</script>
