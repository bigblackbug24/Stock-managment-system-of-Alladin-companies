<?php require_once 'includes/header.php';

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
            <li><a href="gatepass.php">Home</a></li>		  
            <li class="active">Order Detail</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>Order Detail</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>
                 <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    
                      <button class="btn btn-primary button1"> <i class="glyphicon glyphicon-print"></i><a href="#" value="Print" onclick="agreement_printDiv('print_agreement')" style="color:white;"> Print</a> </button>
                </div> <!-- /div-action -->    

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                   
                
                </div> <!-- /div-action -->				

                <table class="table" id="clearorders">
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

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->		
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->

<!--print order Report-->
<div class="row">
      <div class="print_agreement" id="print_agreement" style="display: none;" >
    <div class="col-md-12">

        

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>Print Order Report </div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>
                   

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                   
                
                </div> <!-- /div-action -->				

                <table class="table" id="clearorders">
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

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->		
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->
</div>
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
        $('#clearorders').dataTable();
    });
</script>

<?php require_once 'includes/footer.php'; ?>