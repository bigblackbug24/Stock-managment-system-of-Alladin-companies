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
            <li class="active">Clear Orders</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>Clear Orders</div>
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
                      

                       
                            $sql = "SELECT orders.order_id AS order_id,orders.order_date AS order_date,branches.name AS bname,
                                product.name AS pname, order_detail.quantity AS qty, order_detail.price AS oprice, order_detail.total_cost
                               AS ocost FROM orders INNER JOIN branches ON orders.branch_id = branches.branch_id
                                INNER JOIN order_detail ON order_detail.order_id = orders.order_id
                                 INNER JOIN product ON product.product_id = order_detail.product_id
                                 INNER JOIN gatepass 
                                WHERE orders.order_id = gatepass.order_id";

                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['order_id']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo  $row['bname']; ?></td>
                                    <td><?php echo $row['pname']; ?></td>
                                    <td><?php echo $row['qty']; ?></td>
                                    <td><?php echo $row['oprice']; ?></td>
                                    <td><?php echo $row['ocost']; ?></td>


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
  <!--print Clear order-->
  <div class="row">
        <div class="print_agreement" id="print_agreement" style="display: none;" >
    <div class="col-md-12">

      
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>Print Clear Orders</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>
                
                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                   
                
                </div> <!-- /div-action -->				

                <table class="table" id="clearorders">
                    <thead>
                        <tr>							
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
                      

                       
                            $sql = "SELECT orders.order_id AS order_id,orders.order_date AS order_date,branches.name AS bname,
                                product.name AS pname, order_detail.quantity AS qty, order_detail.price AS oprice, order_detail.total_cost
                               AS ocost FROM orders INNER JOIN branches ON orders.branch_id = branches.branch_id
                                INNER JOIN order_detail ON order_detail.order_id = orders.order_id
                                 INNER JOIN product ON product.product_id = order_detail.product_id
                                 INNER JOIN gatepass 
                                WHERE orders.order_id = gatepass.order_id";

                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['order_id']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo  $row['bname']; ?></td>
                                    <td><?php echo $row['pname']; ?></td>
                                    <td><?php echo $row['qty']; ?></td>
                                    <td><?php echo $row['oprice']; ?></td>
                                    <td><?php echo $row['ocost']; ?></td>


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