<?php
$x=$_POST['firstname'];
$y=$_POST['lastname'];
$servername= "localhost";
$username="root";
$password="";
$dbname="db";
//create a connection
$conn= new mysqli($servername,$username,$password,$dbname);
//check for errors
if($conn->connect_error){
    die("Connection failed: " .connect_error);
}
echo "Connected!";
$sql = "INSTERT INTO `product` (`fname`,`lname`) 
VALUES ('$x','$y')";
if($conn->query(sql)===TRUE){
    echo "Product has been registered!";
} else{
    echo "Error";
}

$conn->close();
?>