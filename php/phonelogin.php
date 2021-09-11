<?php include('config_sql.php'); ?>
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
    $email=$_POST['phonenumber'];
    $password=$_POST['password'];

    $query='SELECT id FROM users WHERE phonenumber="'.$phongnumber.'" AND password="'.$password.';"';
    $res= mysqli_query ($sql ,$query);
    $count = mysqli_num_rows($res);
    $user = $res->fetch();

if($count==1)
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
    $_SESSION['login']="Username and Password did not match";
    header('location:login.php');
}

}
?>
