<?php require_once 'includes/header.php'; ?>


<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php">Home</a></li>		  
            <li class="active">Company</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>Company Detail</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Company </button>
                </div> <!-- /div-action -->				

                <table class="table" id="manageBrandTable">
                    <thead>
                        <tr>
                         <th>Sr #</th>							
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Address</th>
                             <th>Next</th>
<!--							<th style="width:15%;">Options</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i =1;
                        $sql = "SELECT * FROM company";
                     
                        $result = mysql_query($sql);
                        while ($row = mysql_fetch_array($result)) {
                            
                            ?>
                            <tr>
                             <td><?php echo $i++; ?></td>
                                <td><?php echo $row['company_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['contact_no']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><a href="link_vendor.php?comp_id=<?php echo $row['company_id'] ?>"><button class="btn btn-success">Forword to vender</button></td>


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

            <form class="form-horizontal" id="" action="php_action/save_company.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Company</h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>

                    <div class="form-group">
                        <label for="comp_name" class="col-sm-3 control-label">Company Name: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="comp_name" placeholder="Company Name" name="comp_name" autocomplete="off" required>
                        </div>
                    </div> <!-- /form-group-->	      
                    <div class="form-group">
                        <label for="number" class="col-sm-3 control-label">Contact No: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="number" placeholder="number" name="number" autocomplete="off" required>
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" placeholder="email" name="email" autocomplete="off" required>
                        </div>
                    </div> <!-- /form-group-->	
                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Address: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="address" placeholder="address" name="address" autocomplete="off" required> 
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

<!-- edit brand -->
<!--<div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="editBrandForm" action="php_action/editBrand.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Brand</h4>
                </div>
                <div class="modal-body">

                    <div id="edit-brand-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="edit-brand-result">
                        <div class="form-group">
                            <label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editBrandName" placeholder="Brand Name" name="editBrandName" autocomplete="off">
                            </div>
                        </div>  /form-group	         	        
                        <div class="form-group">
                            <label for="editBrandStatus" class="col-sm-3 control-label">Status: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="editBrandStatus" name="editBrandStatus">
                                    <option value="">~~SELECT~~</option>
                                    <option value="1">Available</option>
                                    <option value="2">Not Available</option>
                                </select>
                            </div>
                        </div>  /form-group	
                    </div>         	        
                     /edit brand result 

                </div>  /modal-body 

                <div class="modal-footer editBrandFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                    <button type="submit" class="btn btn-success" id="editBrandBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                </div>
                 /modal-footer 
            </form>
             /.form 
        </div>
         /modal-content 
    </div>
     /modal-dailog 
</div>
 / add modal 
 /edit brand 

 remove brand 
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Brand</h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer removeBrandFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="button" class="btn btn-primary" id="removeBrandBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
            </div>
        </div> /.modal-content 
    </div> /.modal-dialog 
</div> /.modal 
 /remove brand -->

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
$(document).ready(function() {
	$('#manageBrandTable').dataTable();
} );
</script>

<?php require_once 'includes/footer.php'; ?>