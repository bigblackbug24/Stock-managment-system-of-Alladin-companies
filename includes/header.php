<?php require_once 'php_action/core.php'; 

$mainSql = "SELECT * FROM user";
            $mainResult = mysql_query($mainSql);

            // if (mysql_num_rows($mainResult) == 1) {
            //     $value = mysql_fetch_array($mainResult);
            //     $user_id = $value['user_id'];
            //     $action = $value['action'];
            //      $username=$value['username'];
            //     // set session
            //     $_SESSION['action'] = $action;
            //     $_SESSION['userId'] = $user_id;
            //     $_SESSION['username'] = $username;
             

?>

<!DOCTYPE html>
<html>
<head>

	 <title>Stock Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">
<!-- icon  -->
        <link rel="icon" href="assests/images/background.jpg" type="image/gif" sizes="16x16">
     
	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>


	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand text-uppercase" href="#"> <i class="glyphicon glyphicon-user"></i><b><em><?php if(isset($_SESSION['username'])){ echo $_SESSION['username']; } ?></em></b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

      <ul class="nav navbar-nav navbar-right">        

      	<li><a href="index.php"><i class="glyphicon glyphicon-dashboard"></i>  Dashboard</a></li>        
        
        <li><a href="company.php"><i class="glyphicon glyphicon-th-list"></i>Company</a></li>        

        <li><a href="addvendor.php"> <i class="glyphicon glyphicon-th-list"></i> Vendor</a></li>        

        <li ><a href="product.php"> <i class="glyphicon glyphicon-th-list"></i> Product </a></li>     

        <li ><a href="branch.php"> <i class="glyphicon glyphicon-th-list"></i> Branch </a></li> 

        <!-- <li id="navReport"><a href="order.php"> <i class="glyphicon glyphicon-check"></i> Order</a></li> -->

         <li ><a href="order_details.php"> <i class="glyphicon glyphicon-check"></i> Order </a></li>

        <li ><a href="report.php"> <i class="glyphicon glyphicon-check"></i> Report </a></li>

        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">  
           <?php if(isset($_SESSION['action']) &&  $_SESSION['action'] == 'admin'){ ?>
         <li id="topNavSetting"><a href="adduser.php"> <i class="glyphicon glyphicon-user"></i>Add User</a></li> 
         <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Setting</a></li>            
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>  
                         
   <?php }if($_SESSION['action'] == 'others' ){ ?>
              <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Setting</a></li>        
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>            
          <?php             }

     ?>
          </ul>
        </li>        
               
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>
 <?php //require_once 'leftmenu.php';?>
	<div class="container">