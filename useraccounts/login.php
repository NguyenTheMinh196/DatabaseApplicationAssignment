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
        Username: 
        <input type="text" name="username" placeholder="Enter Username"> <br> <br>
         <br> <br>  Password: 
        <input type="password" name="password" placeholder="Enter Password"><br>
        <br> <br>
        <input type="submit" name="submit" value="login" class="btn-primary">


        </form>
     </div>

    
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
    header('location:'.SITEURL.'index.php');
}
else {
    $_SESSION['login']="Username and Password did not match";
    header('location:'.SITEURL.'login.php');
}

}
?>