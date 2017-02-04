<?php
require_once 'php_action/core.php';
  
   $user_id =$_SESSION['userId'];
   $order_id= $_GET['order_id'];
  $today = date("Y-m-d H:i:s"); 
         $query = "INSERT INTO `gatepass` 
         (`user_id`,`order_id`,`order_clear`)
         VALUES
         ('$user_id','$order_id','$today')";
      
         $query_run= mysql_query($query);
if($query){
   
         header("location:clear_all_orders.php");
        
            }    
   
?>