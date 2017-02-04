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
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Product</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Product</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" 
					data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>
                                         <button class="btn btn-primary button1"> <i class="glyphicon glyphicon-print"></i><a href="#" value="Print" onclick="agreement_printDiv('print_agreement')" style="color:white;"> Print</a> </button>
				</div> <!-- /div-action -->				
				
 <table class="table" id="example">
                    <thead>
                        <tr>
                        <th>Sr #</th>
                            <th>Product Name</th>							
                            <th>Product Quantity</th>
                            <th>Unit Price</th>							
                            <th>Total Price</th>
                            <th>Purchase Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            $i= 1;
                            $sql = "SELECT product.name as pname, purchase.qntty, purchase.unit_price,purchase.total_price,purchase.puchase_date
                                    FROM purchase
                                    INNER JOIN product
                                    ON purchase.product_id=product.product_id";

                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['pname']; ?></td>
                                <td><?php echo $row['qntty']; ?></td>
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


<!-- add product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" action="php_action/save_product.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">
	      	<div id="add-product-messages"></div>     	           	       
	        	    	      	        
	        <div class="form-group">
	        	<label for="vendor_id" class="col-sm-3 control-label">Vendor Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				    <select name="vendor_id" id="vendor_id" class="form-control" required>
                                        <option value="">---- Please Select vendor----</option>
                                        <?php
                                        //require 'connection.php';
                                        $sql = "SELECT * FROM vendor";
                                        //echo $sql;
                                        $result = mysql_query($sql);

                                        while ($row = mysql_fetch_array($result)) {
                                            $vendor_id = $row["vendor_id"];
                                            //print_r($comp_id);
                                            $vendor_name = $row["name"];
                                            ?>
                                            <option value="<?php echo $vendor_id; ?>"><?php echo $vendor_name; ?> </option>
                                        <?php }
                                        ?>
                                    </select>
				    </div>
	        </div> <!-- /form-group-->		
	        <div class="form-group">
	        	<label for="name" class="col-sm-3 control-label">Product Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="name" placeholder="Product Name" name="name" autocomplete="off" required>
				    </div>
	        </div> <!-- /form-group-->		
        	         	            	        
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Quantity: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="qty" placeholder="Product qty" name="qty" autocomplete="off" required>
                        </div>
                    </div> <!-- /form-group-->			        	         	            	        
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Unit Price: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="unit_price" placeholder="Product price" name="unit_price" autocomplete="off" required>
                        </div>
                    </div> <!-- /form-group-->			        	         	            	        
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Total Price: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="price"  name="total_price" autocomplete="off" required>
                        </div>
                    </div> <!-- /form-group-->			        	         	            	        
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Purchase Date: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                             <input type="text" class="form-control" id="endDate" name="date" placeholder="Purchase Date" required/>
                        </div>
                    </div> <!-- /form-group-->		        	         	            	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" name="submite" autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!--print product details-->
<div class="row">
     <div class="print_agreement" id="print_agreement" style="display: none;" >
	<div class="col-md-12">

		

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Product</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

							
				
 <table class="table" id="example">
                    <thead>
                        <tr>
                        <th>Sr #</th>
                            <th>Product Name</th>							
                            <th>Product Quantity</th>
                            <th>Unit Price</th>							
                            <th>Total Price</th>
                            <th>Purchase Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            $i= 1;
                            $sql = "SELECT product.name as pname, purchase.qntty, purchase.unit_price,purchase.total_price,purchase.puchase_date
                                    FROM purchase
                                    INNER JOIN product
                                    ON purchase.product_id=product.product_id";

                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['pname']; ?></td>
                                <td><?php echo $row['qntty']; ?></td>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
<script src="custom/js/product.js"></script>
<script src="custom/js/report.js"></script>
<?php require_once 'includes/footer.php'; ?>