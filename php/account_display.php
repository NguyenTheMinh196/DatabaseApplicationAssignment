<?php
  session_start();
require_once '../vendor/autoload.php';
// Update user and password variables according to your system configuration
$user = 'root';
$pass = '';
$dbname = 'assignment';
$host = 'localhost';

global $dbh;
  $mysqldbs = new PDO('mysql:host=localhost;dbname=assignment', $user, $pass);
$mysqldbs->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function getSingleValue($conn, $sql, $parameters)
{
    $q = $conn->prepare($sql);
    $q->exec($parameters);
    return $q->fetchColumn();
}



$state = $_SESSION['login'] ?? null;

if($state = "Login Successfully"){
$username = $_SESSION['user'] ?? "darkdraken";
//update account.php with value belows

// $firstname = getSingleValue($mysqldbs,"SELECT firstname FROM users WHERE username=?",[$username]);
// $lastname =getSingleValue($mysqldbs,"SELECT lastname FROM users WHERE username=?",[$username]);
// $phonenumber =  getSingleValue($mysqldbs,"SELECT phonenumber FROM users WHERE username=?",[$username]);
// $email =  getSingleValue($mysqldbs,"SELECT email FROM users WHERE username=?",[$username]);
// $password = getSingleValue($mysqldbs,"SELECT password FROM users WHERE username=?",[$username]);
// $ID = getSingleValue($mysqldbs,"SELECT ID FROM users WHERE username=?",[$username]);
// $address =  getSingleValue($mysqldbs,"SELECT address FROM users WHERE username=?",[$username]);
// $country = getSingleValue($mysqldbs,"SELECT country FROM users WHERE username=?",[$username]);
// $branch =  getSingleValue($mysqldbs,"SELECT branch FROM users WHERE username=?",[$username]);
// $balance = getSingleValue($mysqldbs,"SELECT balance FROM users WHERE username=?",[$username]);
    include "account.php";

}else{
    echo"you havent login";
}



?>