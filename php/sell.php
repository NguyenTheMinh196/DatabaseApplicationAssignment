<?php
$name=$_POST['name'];
$minimum_price=$_POST['minimum_price'];
$closting_time=$_POST['closting_time'];
$description=$_POST['description'];
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
$sql = "INSTERT INTO `product` (`name`,`minimum_price`,`closing_time`,`description`) 
VALUES ('$name','$minimumprice','$closing_time','$description')";
if($conn->query(sql)===TRUE){
    echo "Product has been registered!";
} else{
    echo "Error";
}

$conn->close();
?>