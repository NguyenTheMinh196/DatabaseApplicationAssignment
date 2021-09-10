<?php include('config2.php'); ?>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/index.module.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
         <br><br>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }

        ?>
       
            

        <form action="" method="POST" class="text-center"> <br> <br>
        Username: 
        <input type="text" name="username" placeholder="Enter Username"> <br> <br>
         <br> <br>  Password: 
        <input type="password" name="password" placeholder="Enter Password"><br>
        <br> <br>
        <a href="phonelogin.php">Or log in with phone number</a>
        <br><br>
        <input type="submit" name="submit" value="login" class="btn-primary">


        </form>
     </div>
     
     <footer>

<!-- footer social media section -->
<div class = "social_media_section">
    <div class="social_buttons"> <a href=""><i class="fab fa-instagram circle-icon"></i></a> <a href=""><i class="fab fa-facebook circle-icon"></i></a> <a href=""><i class="fab fa-linkedin-in circle-icon"></i></a> <a href=""><i class="fab fa-twitter circle-icon"></i></a> </div>
</div>
<div style = "border-left: 2px solid gray; text-align:center;padding-top: 10px;" >
    copyright by ...

</div>
</footer>

    
</body>
        
</html>

<?php
if(isset($_POST['submit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $res= mysqli_query ($conn ,$sql);
    $count = mysqli_num_rows($res);

if($count==1)
{
    $_SESSION['login']="Login Successfully";
    $_SESSION['user']= $username;
    header('location:../index.php');
}
else {
    $_SESSION['login']="Username and Password did not match";
    header('location:'.SITEURL.'login.php');
}

}
?>
