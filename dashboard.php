<?php

 require_once 'includes/header.php'; ?>

<?php 

// $sql = "SELECT * FROM product WHERE status = 1";
// $query = $connect->query($sql);
// $countProduct = $query->num_rows;

// $orderSql = "SELECT * FROM orders WHERE order_status = 1";
// $orderQuery = $connect->query($orderSql);
// $countOrder = $orderQuery->num_rows;

// $totalRevenue = "";
// while ($orderResult = $orderQuery->fetch_assoc()) {
// 	$totalRevenue += $orderResult['paid'];
// }

// $lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
// $lowStockQuery = $connect->query($lowStockSql);
// $countLowStock = $lowStockQuery->num_rows;

// $connect->close();

?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <!-- <h1 class="page-header">Dashboard</h1> -->
                    <ol class="breadcrumb">
                   <li><a href="dashboard.php">Home</a></li>       
                   <li class="active">Dashboard</li>
                   </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

    <div class="row">
        <div class="col-lg-3 col-lg-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Purchase</div>
                        </div>
                    </div>
                </div>
                <a href="link_company.php">
                    <div class="panel-footer">
                        <span class="pull-left">Purchase Product</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>


            </div>
        </div>
           <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                             <i class="fa fa-edit fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div> Order</div>
                        </div>
                    </div>
                </div>
                <a href="branch.php">
                    <div class="panel-footer">
                        <span class="pull-left">Add Order </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>


            </div>
        </div>
        </div>
        <div class="row">
           <div class="col-lg-3 col-md-6 col-lg-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Stock</div>
                        </div>
                    </div>
                </div>
                <a href="stock_detail.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Stock</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>


            </div>
        </div>
           <div class="col-lg-3 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-check fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Reporting</div>
                        </div>
                    </div>
                </div>
                <a href="report.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Report</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>


            </div>
        </div>
    </div>
             <!-- /.row -->
            
            <!-- /.row -->
        </div>	
<!--	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('d'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php if($totalRevenue) {
		    	echo $totalRevenue;
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-usd"></i>Total Cost of Items</p>
		  </div>
		</div> 

	</div>

	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Calendar</div>
			<div class="panel-body">
				<div id="calendar"></div>
			</div>	
		</div>
		
	</div>-->

	


    </div> <!--/row-->    

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

<?php require_once 'includes/footer.php'; ?>