<?php include('config2.php'); ?>
<head>
    <title>Login</title>
  
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
        Phone number: 
        <input type="text" name="phonenumber" placeholder="Enter Phone number"> <br> <br>
         <br> <br>  Password: 
        <input type="password" name="password" placeholder="Enter Password"><br>
        <br> <br>
        <a href="login.php">Or log in with username</a>
        <br><br>
        <input type="submit" name="submit" value="login" class="btn-primary">


        </form>
     </div>
     

    
</body>
        
</html>

<?php
if(isset($_POST['submit']))
{
    $phonenumber=$_POST['phonenumber'];
    $password=$_POST['password'];

    $sql="SELECT * FROM users WHERE phonenumber='$phonenumber' AND password='$password'";
    $res= mysqli_query ($conn ,$sql);
    $count = mysqli_num_rows($res);

if($count==1)
{
    $_SESSION['login']="Login Successfully";
    $_SESSION['user']= $phonenumber;
    header('location:'.SITEURL.'index.php');
}
else {
    $_SESSION['login']="Username and Password did not match";
    header('location:'.SITEURL.'login.php');
}

}
?>
