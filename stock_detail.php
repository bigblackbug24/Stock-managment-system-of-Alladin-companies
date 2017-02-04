<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Stock</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Stock</div>
			
            </div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                  
                     <button class="btn btn-primary button1"> <i class="glyphicon glyphicon-print"></i><a href="#" value="Print" onclick="agreement_printDiv('print_agreement')" style="color:white;"> Print</a> </button>
                </div> <!-- /div-action -->             
			
          <table id="example" class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>							
                            <th>Product Quantity in stock</th>
                            <th>Product Quantity</th>
                            <th>Unit Price</th>							
                            <th>Total Price</th>
                            <th>Purchase Date</th>

                        </tr>
                    </thead>
                    <tbody>                       
                            <?php
                            $sql = "SELECT product.name as pname, stock.qntty AS stock_qntty, stock.unit_price,stock.total_price,stock.puchase_date,purchase.qntty AS puchase_qntty
                                    FROM stock
                                    INNER JOIN product
                                    ON stock.product_id=product.product_id
                                    INNER JOIN purchase
                                    ON purchase.product_id=product.product_id";
                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                <td><?php echo $row['pname']; ?></td>
                                <td><?php echo $row['stock_qntty']; ?></td>
                                <td><?php echo $row['puchase_qntty']; ?></td>
                                <td><?php echo $row['unit_price']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                                <td><?php echo $row['puchase_date']; ?></td> 
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
<!--print Stock Details-->
<div class="row">
      <div class="print_agreement" id="print_agreement" style="display: none;" >
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Stock</div>
			
            </div> <!-- /panel-heading -->
			<div class="panel-body">
				<div class="remove-messages"></div>  
          <table id="example" class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>							
                            <th>Product Quantity in stock</th>
                            <th>Product Quantity</th>
                            <th>Unit Price</th>							
                            <th>Total Price</th>
                            <th>Purchase Date</th>

                        </tr>
                    </thead>
                    <tbody>                       
                            <?php
                            $sql = "SELECT product.name as pname, stock.qntty AS stock_qntty, stock.unit_price,stock.total_price,stock.puchase_date,purchase.qntty AS puchase_qntty
                                    FROM stock
                                    INNER JOIN product
                                    ON stock.product_id=product.product_id
                                    INNER JOIN purchase
                                    ON purchase.product_id=product.product_id";
                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                <td><?php echo $row['pname']; ?></td>
                                <td><?php echo $row['stock_qntty']; ?></td>
                                <td><?php echo $row['puchase_qntty']; ?></td>
                                <td><?php echo $row['unit_price']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                                <td><?php echo $row['puchase_date']; ?></td> 
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
<script>
    $('#qty,#unit_price').change(function () {
        var qty = parseFloat($('#qty').val()) || 0;
        var unit_price = parseFloat($('#unit_price').val()) || 0;
        $('#price').val(qty * unit_price);
    });
</script>
<script src="custom/js/product.js"></script>
<script src="custom/js/report.js"></script>
<?php require_once 'includes/footer.php'; ?>
