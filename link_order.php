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

                <table class="table" id="order_detail">
                    <thead>
                        <tr>  
                        <th>Sr #</th>                          
                            <th>Branch Name</th>
                            <th>Order Date</th>
                            <th>Product_name</th>
                            <th>Qunatity</th>
                            <th>Price</th>
                            <th>Total Cost</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i =1;
                         $get_id = $_GET['bran_id'];
                            $sql = "SELECT branches.name as bname,orders.order_date as date,order_detail.quantity as order_quantity 
                                ,order_detail.price as order_price ,order_detail.total_cost as order_cost ,product.name as pname FROM branches
                                    INNER JOIN orders
                                    ON branches.branch_id=orders.branch_id
                                    INNER JOIN order_detail
                                    ON orders.order_id = order_detail.order_id
                                    INNER JOIN product
                                    ON order_detail.product_id = product.product_id
                                    WHERE order_detail.order_id = '$get_id'";

                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                 <td><?php echo $i++; ?></td>
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

            <form class="form-horizontal" name="myform" action="php_action/process_order_details.php" method="POST" autocomplete="off">
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

                            <select name="branch_id" class="form-control" required>
                                
                                <?php
                                $get_id = $_GET['bran_id'];
                                $sql = "select * from branches where branch_id = '$get_id'";
                                $result = mysql_query($sql);
                                while ($row = mysql_fetch_array($result)) {
                                    ?>
                                    n
                                    <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['name']; ?> </option>
                                <?php } ?>
                            </select>
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
                        <div class="form-group">
                            <label for="product_id" class="col-md-4 control-label">Product Name</label>                             
                            <div class="col-md-6">                                
                                <select name="prod_name" id="prod_name"  class="form-control" required> 
                                    <option value="">Select Product</option>
                                    <?php
                                while ($row = mysql_fetch_array($que_result)) {
                                    ?>

                                    <option value="<?php echo $row['product_id']; ?>"><?php echo $row['name']; ?> </option>
                                
                                <?php }?>
                                    
                                </select>
                                <!--<input type="text" id="display_area" name="id" value="">-->
                                <?php
                                //$sql = $display;
//                            $select = "select qntty from stock where product_id = '$sql'";
//
//                            $result = mysql_query($select);
//                            $result1 = mysql_fetch_array($result);
//                            echo $result1['qntty'];
                                ?>
                              
                                    
                               
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="qttyy" id="qttyy">
                            </div>
                               
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="col-md-4 control-label">Quantity</label>
                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control" name="qty" id="qty" required onblur = "subtract(this)">                              
                                <span class="help-block">
                                    <strong></strong>
                                </span>                            
                            </div>
                        </div>                                             
                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" id="price"name="price" required onblur = "subtract(this)">                                
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
<!-- / add modal -->


<script type="text/javascript">
    $(document).ready(function () {
        $('#order_detail').dataTable();
    });
</script>
<script>
// Receive Single value from php file via ajax call
//    function get_product_id(product_id) {
//        //alert(product_id);
//
//        $.ajax({
//            type: 'post',
//            url: 'get_product_qty.php',
//            data: {
//                product_id: product_id
//            },
//            success: function (data) {
//                var product_id = data.split(",");
//                $('#quantity').val(data);
//                $('#price').val(data1);
//               alert(data);
//                  alert(data1)
//            }
//            
//        })
//
//    }
    
$('#prod_name').change(function(){
               
    $.ajax({
        type:'post',
        url:'get_product_qty.php',
        data: 'c_id='+ $(this).val(),                 
        success: function(value){
             var data = value.split(",");
            $('#qttyy').val(data[0]);

            $('#price').val(data[1]);
        }
    }); 
  });

   function subtract(which) {

        var x = parseFloat(which.value);
//        if (isNaN(x)) {
//            alert("Remember - only integer or decimal numbers are allowed!");
//            which.value = "";
//            return false;
//        }
        if (x < 1) {
            alert("Please Enter a Valid Amount");
            which.value = "";
            return false;
        }
        var a = document.myform.price.value;
        var b = document.myform.qty.value;
        document.myform.total_cost.value = (a * b).toFixed(2);
    }
</script>
<?php include 'includes/footer.php'; ?>
