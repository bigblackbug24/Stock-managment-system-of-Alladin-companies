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

$query_test = "select * from product";
$que_result_test = mysql_query($query_test);
//    echo "<pre>";
//    print_r($row);
//    exit();    
?>
<script type="text/javascript">
    function agreement_printDiv(print_agreement) {
        var printContents = document.getElementById(print_agreement).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }


    function Popup(data)
    {
        var mywindow = window.open('', 'my div', 'height=400,width=800');
        mywindow.document.write('<html><head><title  style="background-color:yellow;">Order Details</title>');
        /*optional stylesheet*/ //  mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');

        mywindow.document.write('</head><body><tr color="red"></tr>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }


</script>
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
                    <button class="btn btn-primary button1"> <i class="glyphicon glyphicon-print"></i><a href="#" value="Print" onclick="agreement_printDiv('print_agreement')" style="color:white;"> Print Order</a> </button>
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
                        $i = 1;
//                        $sql = "SELECT branches.name as bname,orders.order_date as date,order_detail.quantity as order_quantity 
//                                ,order_detail.price as order_price ,order_detail.total_cost as order_cost ,product.name as pname FROM branches
//                                    INNER JOIN orders
//                                    ON branches.branch_id=orders.branch_id
//                                    INNER JOIN order_detail
//                                    ON orders.order_id = order_detail.order_id
//                                    INNER JOIN product
//                                    ON order_detail.product_id = product.product_id
//                                    ORDER BY order_detail.det_id DESC LIMIT 1
//                                    ";

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
//                        $row = mysql_fetch_array($result);
//                        echo "<pre>";
//                        print_r($row);
//                        exit();
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
                        <label for="order_id" class="col-md-2 control-label">Order ID</label>
                        <label for="branch_id" class="col-md-3 control-label">Branch Name</label>
                        <label for="order_date" class="col-md-3 control-label">Order Date</label>
                        <label for="order_date" class="col-md-3 control-label">Total Order</label>

                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                            <input id="order_id" type="text" readonly="" class="form-control" name="order_id" value="<?php echo $data[0]; ?>">                           
                            <span class="help-block">
                                <strong></strong>
                            </span>                          
                        </div>

                        <div class="col-md-3">

                            <select name="branch_id" class="form-control" required>
                                <option value="">Select Branch</option>
                                <?php
                                $sql = "select * from branches";
                                $result = mysql_query($sql);
                                while ($row = mysql_fetch_array($result)) {
                                    ?>

                                    <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['name']; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input id="order_date" type="date" class="form-control" name="order_date" value="" required>                              
                            <span class="help-block">
                                <strong></strong>
                            </span>                             
                        </div>

                        <div class="col-md-2">
                            <input id="total_order" type="text" class="form-control" name="total_order" value="" required>                              
                            <span class="help-block">
                                <strong></strong>
                            </span>                             
                        </div>

                    </div>



                    <div class="form-group">
                        <label for="serial_no" class="col-md-1 control-label">Sr.No</label> 
                        <label for="product_id" class="col-md-3 control-label">Product Name</label>   
                        <label for="quantity" class="col-md-2 control-label">Quantity</label>
                        <label for="price" class="col-md-2 control-label">Price</label>
                        <label for="total_cost" class="col-md-3 control-label">Total Cost</label>
                    </div>

                    <!--Testing the code-->
                    <div class="input_fields_wrap row">

                    </div>                  
                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <input type='button' value='Add Button' id='addButton' class="add_field_button btn-primary">
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
<!--print order_details-->
<div class="row">
    <div class="print_agreement" id="print_agreement" style="display: none;" >
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Print Order</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body">

                    <div class="remove-messages"></div>

                    <table class="table" id="order_detail">
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
                                <tr>
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
</div>


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





    // multiple order details
    $(document).ready(function () {

//        var max_fields = 10; //maximum input boxes allowed
        var max_fields = $("#total_order").change(function () {
            var max_fields = $(this).val();
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var i = 0; //initlal text box count
            $(add_button).click(function (e) { //on add input button click

                e.preventDefault();
                if (i < max_fields) { //max input box allowed
                    i++; //text box increment
                    var html = '<div class="clearfix product_row">';
                    html += '<div class="col-md-2"> <input id="serial_no_" type="text" class="form-control serial_no" name="serial_no" value = "' + i + '" ></div>';
                    html += '<div class="col-md-3"> <select name="prod_name_' + i + '" id="product-dropdown_' + i + '"  class="product-dropdown_' + i + ' form-control product_name" required onchange="return getValue();"> <option value="Select Product">Select Product</option>  <?php while ($row = mysql_fetch_array($que_result_test)) { ?> <option value="<?php echo $row['product_id']; ?>"><?php echo $row['name']; ?> </option><?php } ?>  </select></div>'; //add input box
                    html += '<div class="col-md-2"> <input  id="qtty_' + i + '" type="text" class=" qtty_' + i + ' form-control quantity" name="qty_' + i + '"  required ></div>';
                    html += '<div class="col-md-2"> <input  type="text" class="price pprice_' + i + ' form-control" id="price_' + i + '" name="price_' + i + '" required > </div>';
                    html += '<div class="col-md-2">  <input type="text" class="total form-control" record-id="' + i + '" name="total_cost_' + i + '" id="total_cost_' + i + '" required>  </div>';
                    html += '</div>';
                    $(wrapper).append(html);

                    $('.input_fields_wrap').on('change', '.product_name', function () {

                        console.log($(this).val());
                        var currEle = $(this);
                        $.ajax({
                            type: 'post',
                            url: 'get_product_qty.php',
                            data: 'c_id=' + $(this).val(),
                            // alert("data" +data);
                            success: function (value) {
                                var data = value.split(",");
//                            $('#qttyy_'+i+').val(data[0]);
                                // console.log(currEle.parents('.product_row'));
                                //console.log(currEle.parents('.product_row').find('input.price'));
                                currEle.parents('.product_row').find('input.price').val(data[1]);
                                //$('#price').val(data[1]);
                            }
                        });

                    });


                }

            });



            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });


    });

</script>

<script>


    $(document).ready(function () {

        $(document).on("click", "input[name^='total_cost']", function () {

            var quantityInputId = $(this).attr('id');

            var recordId = $(this).attr('record-id');

            var quantityInputIdVal = $("#qtty_" + recordId).val();

            var priceInputIdVal = $("#price_" + recordId).val();

            var totalCost = (parseInt(quantityInputIdVal) * parseInt(priceInputIdVal));

            $("#total_cost_" + recordId).val(totalCost);



        });
    });


</script>

<?php include 'includes/footer.php'; ?>
