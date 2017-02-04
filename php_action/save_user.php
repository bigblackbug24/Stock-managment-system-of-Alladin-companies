<?php
require_once 'core.php';

if($_POST){
   //$ID = $_POST['ID'];
 $NAME =$_POST['username'];
 $EMAIL =$_POST['email'];
   $password =$_POST['password'];
   $action =$_POST['action'];
   

$query = "INSERT INTO `user` 
         (`username`,`email`,`password`,`action`)
         VALUES
         ('$NAME','$EMAIL','$password','$action')";
         $query_run= mysql_query($query);
         header("location:../adduser.php");
                 }else{
            echo "data failed to submit ";
            header("location:../dashboard.php");
         }
   
?>