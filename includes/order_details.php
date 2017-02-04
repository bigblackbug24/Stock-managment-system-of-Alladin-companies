<?php
include 'includes/header.php';

                          
//mysql_connect("localhost","root","");
//mysql_select_db("inventory");
// select the last insert id of order table...
$q = "SELECT * FROM orders ORDER BY order_id DESC LIMIT 1;";
$result = mysql_query($q);
$data = mysql_fetch_array($result);
// get the product id which is used as Forign key in order_details table
$query = "select * from product";
$que_result = mysql_query($query);
//    echo "<pre>";
//    print_r($row);
//    exit();    
?>
<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php">Home</a></li>       
            <li class="active">Order</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Order</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Order </button>
                </div> <!-- /div-action -->             

                <table class="table" id="manageBrandTable">
                    <thead>
                        <tr>                            
                            <th>Branch Name</th>
                            <th>Order Date</th>
                            <th>Product_name</th>
                            <th>Qunatity</th>
                            <th>Price</th>
                            <th>Total Cost</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>               
                          <?php
                          

                         
                          
                          
                          
                          
                            $sql = "SELECT branches.name as bname,orders.order_date as date,order_detail.quantity as order_quantity 
                                ,order_detail.price as order_price ,order_detail.total_cost as order_cost ,product.name as pname FROM branches
                                    INNER JOIN orders
                                    ON branches.branch_id=orders.branch_id
                                    INNER JOIN order_detail
                                    ON orders.order_id = order_detail.order_id
                                    INNER JOIN product
                                    ON order_detail.product_id = product.product_id
                                    ";

                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <td><?php echo $row['bname']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['pname']; ?></td>
                                <td><?php echo $row['order_quantity']; ?></td>
                                <td><?php echo $row['order_price']; ?></td>
                                <td><?php echo $row['order_cost']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>


                </table>
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->      
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="" action="php_action/process_order_details.php" method="POST" autocomplete="off">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Order</h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>
                          <div class="form-group">
                        <label for="order_id" class="col-md-4 control-label">Order ID</label>
                        <div class="col-md-6">
                            <input id="order_id" type="text" readonly="" class="form-control" name="order_id" value="<?php echo $data[0]; ?>">                           
                            <span class="help-block">
                                <strong></strong>
                            </span>                          
                        </div>
                    </div>
                <div class="form-group">
                        <label for="branch_id" class="col-md-4 control-label">Branch Name</label>

                        <div class="col-md-6">

                            <select name="branch_id" class="form-control">
                                <option>Select Branch</option>
                                <?php
                                $sql = "select * from branches";
                                $result = mysql_query($sql);
                                while ($row = mysql_fetch_array($result)) {
                                    ?>

                                    <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['name']; ?> </option>
                                
                                <?php }
                                 
                                ?>
                            </select>
                        </div>

                    </div>
              
                    <div class="form-group">
                        <label for="product_id" class="col-md-4 control-label">Product ID</label>                             
                        <div class="col-md-6">                                
                            <select name="product_id" id="product_id" class="form-control"> 
                                <option>Select Product</option>
                                <?php
                                while ($row = mysql_fetch_array($que_result)) {
                                    ?>

                                    <option value="<?php echo $row['product_id']; ?>"><?php echo $row['name']; ?> </option>
                                
                                <?php }
                                
//                                    $select = "select unit_price from purchase where product_id = $product_id";
//                               $select_record= mysql_query($select);
//                               $row = mysql_fetch_array($select_record);
                           
                                
                                ?>
                                   
                            </select>
                           
                        </div>                                
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="col-md-4 control-label">Quantity</label>
                        <div class="col-md-6">
                            <input id="quantity" type="text" class="form-control" name="quantity" required>                              
                            <span class="help-block">
                                <strong></strong>
                            </span>                            
                        </div>
                    </div>                                             
                    <div class="form-group">
                        <label for="price" class="col-md-4 control-label">Price</label>

                        <div class="col-md-6">
                            <input id="price" type="text" class="form-control" name="price" required >                                
                            <span class="help-block">
                                <strong></strong>
                            </span>                             
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total_cost" class="col-md-4 control-label">Total Cost</label>

                        <div class="col-md-6">
                            <input id="total_cost" type="text" class="form-control" name="total_cost" required>                               
                            <span class="help-block">
                                <strong></strong>
                            </span>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="order_date" class="col-md-4 control-label">Order Date</label>
                        <div class="col-md-6">
                            <input id="order_date" type="date" class="form-control" name="order_date" value="" required>                              
                            <span class="help-block">
                                <strong></strong>
                            </span>                             
                        </div>
                    </div>

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

<!-- /remove brand -->
<script src="custom/js/brand.js"></script>
<!--<script type="text/javascript">
    $(document).ready(function () {
        $('#manageBrandTable').dataTable();       
    });
</script>-->
<script type="text/javascript">
        $(document).ready(function(){
            $('#product_id').change(function(){
                   var url = + $(this).val();
                   
                   window.location.href = "somepage.php?w1=" + url; 

//                    $('#display_area').load(url);
//                    var abc = $('#display_area').load(url);
               alert("value is is:" + url);
               // var a = document.myform.display_area.value;
              // var display_area =   $('#display_area').load(url);
//               document.myform.display_area.value = url;
                 // alert("value is is:" + display);
            });
        });
</script>
<?php include 'includes/footer.php'; ?>
