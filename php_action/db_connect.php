<?php 	

$localhost = "127.0.0.1";
$username = "root";
$password = "";
//$dbname = "inventory";
$con = mysql_connect($localhost,$username ,$password );
 $connect=mysql_select_db("inventory",$con);
// // db connection
 //$connect = new mysqli($localhost, $username, $password, $dbname);
// // check connection
/*if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
   //echo "Successfully connected";
}

// mysql_connect("localhost","root","");
//  mysql_select_db("inventory");
*/
?>
