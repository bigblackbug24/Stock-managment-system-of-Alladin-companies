<?php require_once 'includes/header_1.php';

 ?>


<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="gatepass.php">Home</a></li>		  
            <li class="active">Gatepass</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>Order Confirmation</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                <a href="clear_data.php?order_id=<?php echo $ID;?>"><button class="btn btn-success button1" > <i class="glyphicon glyphicon-tick"></i>Check All oreders </button></a>
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Check gate Pass </button>
                
                </div> <!-- /div-action -->				

                <table class="table" id="manageBrandTable">
                    <thead>
                        <tr>				
                         <th>Sr #</th>			
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Branch Name</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Net Price</th>
                            <th>Total Price</th>
<!--							<th style="width:15%;">Options</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        if (isset($_POST['submit'])) {

                            $ID = $_POST['order_id'];
                            $sql = "SELECT orders.order_id AS order_id,orders.order_date AS order_date,branches.name AS bname,
                                product.name AS pname, order_detail.quantity AS qty, order_detail.price AS oprice, order_detail.total_cost
                               AS ocost FROM orders INNER JOIN branches ON orders.branch_id = branches.branch_id
                                INNER JOIN order_detail ON order_detail.order_id = orders.order_id
                                 INNER JOIN product ON product.product_id = order_detail.product_id
                                WHERE orders.order_id = " . $ID . "";

                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                  <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['order_id']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo $row['bname']; ?></td>
                                    <td><?php echo $row['pname']; ?></td>
                                    <td><?php echo $row['qty']; ?></td>
                                    <td><?php echo $row['oprice']; ?></td>
                                    <td><?php echo $row['ocost']; ?></td>


                                </tr>
                                <?php
                            
                        }
                        ?>
                    </tbody>
                          <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                    <td colspan="6"><a href="clear_data.php?order_id=<?php echo $ID;?>"><button class="btn btn-success button1" > <i class="glyphicon glyphicon-tick"></i>Order Clear </button></a></td>
                                </tr>
                            </tfoot>    
                         <?php    }
                        ?>
                </table>
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->		
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="" action="gatepass.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Order Confirmation</h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>

                    <div class="form-group">
                        <label for="comp_name" class="col-sm-3 control-label">Order Id: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="order_id" placeholder="Order Id" name="order_id" autocomplete="off" required>
                        </div>
                    </div> <!-- /form-group-->	      

                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary" id="submit" name="submit"  autocomplete="off">Save Changes</button>
                </div>
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / add modal -->



<script type="text/javascript">

    /*$(document).ready(function() {
     // top bar active
     //$('#navBrand').addClass('active');
     // manage brand table
     ("#manageBrandTable").dataTables({
     "bJQueryUI":true,
     "bSort":true,
     "bPaginate":true, // Pagination True 
     "sPaginationType":"full_numbers", // And its type.
     "iDisplayLength": 10
     });
     */
    $(document).ready(function () {
        $('#manageBrandTable').dataTable();
    });
</script>

<?php require_once 'includes/footer.php'; ?>