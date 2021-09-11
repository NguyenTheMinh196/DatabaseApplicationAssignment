<?php
require_once('config_sql.php');
$now = new DateTime();
$format = 'Y-m-d H:i:s';
$past = DateTime::createFromFormat($format, '2021-02-10 10:05:00');;
$future = DateTime::createFromFormat($format, '2029-12-15 15:16:17');;
$display = $sql->query('SELECT P.closingtime, P.id FROM product P WHERE P.status = "not sold";');
foreach($display as $product){
    $new_date = date( "Y-m-d H:i:s", strtotime( $product['closingtime'] ) );
    if(strtotime((new DateTime())->format("Y-m-d H:i:s")) > strtotime($product['closingtime'])){
        $query = ('CALL trade('.(int)$product['id'].')');
        $bid = $sql->query($query);
        echo("Lon hon");
    }
    // echo($product['id']);
    // print_r($new_date);
    // print_r($now);

}?>