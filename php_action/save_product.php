<?php

require_once 'core.php';
   //mysql_set_charset('utf8');
   //query for insert data into tables
   
if($_POST){
   //$ID = $_POST['ID'];
   $vendor_id =$_POST['vendor_id'];
   $NAME= $_POST['name'];
   

          $query = "INSERT INTO `product` 
         (`vendor_id`,`name`)
         VALUES
         ('$vendor_id','$NAME')";
         $query_run= mysql_query($query);
         $q = "SELECT * FROM product ORDER BY product_id DESC LIMIT 1;";
       $result = mysql_query($q);
      $data = mysql_fetch_array($result);
     $data1 = $data[0];

   $qty= $_POST['qty'];
   $unit_price= $_POST['unit_price'];
   $total_price= $_POST['total_price'];
   $date= $_POST['date'];
           $purchase = "INSERT INTO `purchase` 
         (`product_id`,`qntty`,`unit_price`,`total_price`,`puchase_date`)
         VALUES
         ('$data1','$qty','$unit_price','$total_price','$date')";
         $query_run= mysql_query($purchase);

         $query_stock = "INSERT INTO `stock` 
         (`product_id`,`qntty`,`unit_price`,`total_price`,`puchase_date`)
         VALUES
         ('$data1','$qty','$unit_price','$total_price','$date')";   
         $stock_run= mysql_query($query_stock);
             header("location:../product.php");
                 }
                 else{
            echo "data failed to submit ";
            header("location:../product.php");
           
         }
   
?>