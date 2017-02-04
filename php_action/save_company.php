<?php
require_once 'core.php';

if($_POST){
   //$ID = $_POST['ID'];
 $NAME =$_POST['comp_name'];
 $EMAIL =$_POST['email'];
   $NUMBER =$_POST['number'];
   $ADDRESS =$_POST['address'];
   

$query = "INSERT INTO `company` 
         (`company_name`,`email`,`contact_no`,`address`)
         VALUES
         ('$NAME','$EMAIL','$NUMBER','$ADDRESS')";
         $query_run= mysql_query($query);
         header("location:../addvendor.php");
                 }else{
            echo "data failed to submit ";
            header("location:../company.php");
         }
   
?>