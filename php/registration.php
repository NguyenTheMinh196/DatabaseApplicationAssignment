<?php
include('config_sql.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>registration</title>

  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
    
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
	$password 		= $_POST['password'];
    $address	= $_POST['address'];
    $country	= $_POST['country'];
    // $image	= $_POST['image'];
    $branch	= $_POST['branch'];
    $balance	= $_POST['balance'];
    
    $fileName = basename($_FILES['img']["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
     
    // Allow certain file formats 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
        $image = $_FILES['img']['tmp_name']; 
        $imgContent = addslashes(file_get_contents($image)); 
            $query = 'INSERT INTO users (firstname, lastname,username , email, phonenumber, password, address, country , image, branch, balance ) VALUES(?,?,?,?,?,?,?,?,?,?,?)';
		    $stmtinsert = $sql->prepare($query);
		    $result = $stmtinsert->execute([$firstname, $lastname,$username , $email, $phonenumber, $password, $address,$country,$imgContent, $branch, $balance]);
        }
}?>
    </div>


    <div>
        <form action="registration.php" method="post" enctype="multipart/form-data">
            <div class="container" style = "display: block">
                <h1>Registration</h1>
                <p>Please fill up the form</p>
                <br>

                <label for="firstname"><b>Firstname</b></label>
                <input type="text" name="firstname" required>
                <br>

                <label for="lastname"><b>Lastname</b></label>
                <input type="text" name="lastname" required>
                <br>

                <label for="username"><b>Username</b></label>
                <input type="text" name="username" required>
                <br>

                <label for="email"><b>Email Address</b></label>
                <input type="email" name="email" required>
                <br>

                <label for="phonenumber"><b>Phone Number</b></label>
                <input type="text" name="phonenumber" required>
                <br>

                <label for="password"><b>Password</b></label>
                <input type="password" name="password" required>
                <br>

                <label for="address"><b>Address</b></label>
                <input type="text" name="address">
                <br>

                <label for="country"><b>Country</b></label>
                <input type="text" name="country" required>
                <br>

                <label for="image"><b>Profile Image</b></label>
                <input type="file" name="img" accept = "image/png, image/jpeg" required>
                <br>

                <label for = "balance"><b>Balance</b></label>
                <input type = "number" min = 0 name = "balance" required>
                <br>

                <label for = "branch"><b>Branch</b></label>
                <select id = "branch" name = "branch" required>
                <option value = "1"> Ha Noi</option>
                <option value = "2"> Ho Chi Minh</option>
                </select>
                <br>


                <input type="submit" name="create" value="Sign Up">
        </div>
        </form>
    </div>

</body>
</html>