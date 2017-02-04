<?php require_once 'includes/header.php'; ?>

<div class="row">
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-9 col-lg-offset-2">
                    <!-- <h1 class="page-header">Dashboard</h1> -->
                    <ol class="breadcrumb">
                   <li><a href="dashboard.php">Home</a></li>       
                   <li class="active">Report</li>
                   </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

    <div class="row">
        <div class="col-lg-3 col-lg-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Stock</div>
                        </div>
                    </div>
                </div>
                <a href="product_purchased_report.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
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
                             <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Order Detail</div>
                        </div>
                    </div>
                </div>
                <a href="order_report.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Order</span>
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
                             <i class="fa fa-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Gate Pass Report</div>
                        </div>
                    </div>
                </div>
                <a href="clear_view_orders.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Detail </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>


            </div>
        </div>
        </div>   
            <!-- /.row -->
        </div>	</div>
<script src="custom/js/report.js"></script>

<?php require_once 'includes/footer.php'; ?>