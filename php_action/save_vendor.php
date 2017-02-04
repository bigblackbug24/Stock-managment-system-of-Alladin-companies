<?php

require_once 'core.php';
   //mysql_set_charset('utf8');
   //query for insert data into tables
   
if($_POST){
   //$ID = $_POST['ID'];
   $Company_id =$_POST['company_id'];
   $NAME= $_POST['name'];
   $EMAIL =$_POST['email'];
   $NUMBER =$_POST['number'];
   $ADDRESS =$_POST['address'];
   


         $query = "INSERT INTO `vendor` 
         (`company_id`,`name`,`email`,`contact_no`,`address`)
         VALUES
         ('$Company_id','$NAME','$EMAIL','$NUMBER','$ADDRESS')";
         $query_run= mysql_query($query);

         header("location:../product.php");
                 }
                 else{
            echo "data failed to submit ";
            header("location:../addvendor.php");
         }
   
?>