<?php

require_once 'core.php';

if (isset($_POST['submit'])) {
    $c_name = $_POST["name"];
    $c_address = $_POST["address"];
    $contact_no = $_POST["contact_no"];
    $c_email = $_POST["email"];
    $departments = $_POST["depatment_name"];
    $query = "INSERT INTO branches SET   
                                `name`= '$c_name',
		                `address`  = '$c_address',
				`contact_no`     = '$contact_no',
				`email` =  '$c_email',
				`departments` =  '$departments'
                 ";
   
    if (mysql_query($query)) {
        echo "<h1><center>Company has been Registered</center></h1>";
        header('location:../branch.php');
    } else {
        echo "<h1><center>Company has been not Registered</center></h1>";
        header('location:../branch.php');
    }
}
?>
