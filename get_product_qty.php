<?php

    require_once 'php_action/db_connect.php';
    $id = $_REQUEST['c_id'];//same name as in ajax data

    
    //fire query using this id and get the name of employee and echo it
    $sql="SELECT qntty, unit_price FROM stock where product_id = $id";
    $runQry = mysql_query($sql);
    $get_Array = mysql_fetch_array($runQry);
    $qntty  = $get_Array['qntty'];
       $price  = $get_Array['unit_price'];
 echo $qntty.",".$price;
    
//        $sql="SELECT qntty, unit_price FROM stock where product_id = $id";
//    $runQry = mysql_query($sql);
//    $get_Array = mysql_fetch_array($runQry);
////    $qntty  = $get_Array['qntty'];
//   $price  = $get_Array['unit_price'];
////    echo $qntty;
//    echo $price;

?>