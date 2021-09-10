<?php
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    
</head>
<body>
    <div>
    <?php

if(isset($_POST['create'])){
	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
    $username 		= $_POST['username'];
	$email 			= $_POST['email'];
	$phonenumber	= $_POST['phonenumber'];
	$password 		= ($_POST['password']);
    $ID	= $_POST['ID'];
    $address	= $_POST['address'];
    $city	= $_POST['city'];
    $country	= $_POST['country'];
    $image	= $_POST['image'];

		$sql = "INSERT INTO users (firstname, lastname,username , email, phonenumber, password , ID , address , city , country , image ) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		$stmtinsert = $sql->prepare($sql);
		$result = $stmtinsert->execute([$firstname, $lastname,$username , $email, $phonenumber, $password, $ID, $address, $city,$country,$image]);
		if($result){
			echo 'Successfully saved.';
		}else{
			echo 'There were erros while saving the data.';
		}
}else{
	echo 'No data';
} ?>
    </div>


    <div>
        <form action="registration.php" method="post">
            <div class="container">
                <h1>Registration</h1>
                <p>Please fill up the form</p>
                <label for="firstname"><b>Firstname</b></label>
                <input type="text" name="firstname">

                <label for="lastname"><b>Lastname</b></label>
                <input type="text" name="lastname">

                <label for="username"><b>Username</b></label>
                <input type="text" name="username">
            
                <label for="email"><b>Email Address</b></label>
                <input type="email" name="email">

                <label for="phonenumber"><b>Phone Number</b></label>
                <input type="text" name="phonenumber">

                <label for="password"><b>Password</b></label>
                <input type="password" name="password">

                <label for="ID"><b>ID</b></label>
                <input type="text" name="ID">

                <label for="address"><b>Address</b></label>
                <input type="text" name="address">

                <label for="city"><b>City</b></label>
                <input type="text" name="city">

                <label for="country"><b>Country</b></label>
                <input type="text" name="country">

                <label for="image"><b>Profile Image</b></label>
                <input type="file" name="image">

                <input type="submit" name="create" value="Sign Up">
        </div>
        </form>
    </div>

</body>
</html>