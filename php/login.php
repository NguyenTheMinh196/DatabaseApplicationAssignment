<?php require_once('config_sql.php'); 
session_start();?>
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
        Email: 
        <input type="text" name="email" placeholder="Enter Email"> <br> <br>
         <br> <br>  Password: 
        <input type="password" name="password" placeholder="Enter Password"><br>
        <br> <br>
        <a href="phonelogin.php">Or log in with phone number</a>
        <br><br>
        <a href="registration.php">Register</a>
        <br><br>

        <input type="submit" name="submit" value="login" class="btn-primary">


        </form>
     </div>
     
     

    
</body>
        
</html>

<?php
if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query='SELECT id FROM users WHERE email="'.$email.'" AND password="'.$password.'"';
    $res= $sql->query($query);
    $user = $res->fetch();

if($res != NULL)
{
    if($user['id'] != 1){
        $_SESSION['login']="Login Successfully";
        $_SESSION['user']= $user['id'];
        header('location:../index.php');
    }
    elseif($user['id'] == 1){
        $_SESSION['login']="Login Successfully";
        $_SESSION['user']= $user['id'];
        header('location:admin.php');
    }
}
else {
    echo("YOU WRONG");
}

}
?>
