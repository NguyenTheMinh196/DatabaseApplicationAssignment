<?php
require_once('./vendor/autoload.php');
class MongoDatabase{
    function __construct()
    {
        $this -> $db = ( new MongoDB/Client)->asm->product;

    }
    public function insertNewItem( $iteminfo = [])
    {
        if(empty($iteminfo)){
            return false;
        }
        $insertable = $this->db->insertOne([
            foreach($iteminfo as $info => $value)
            {
                $info => $value;
            };])
    }
}
?>
