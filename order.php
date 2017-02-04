<?php include 'includes/header.php';   

mysql_connect("localhost","root","");
mysql_select_db("inventory");

    $dropdown = "select * from branches";
    $result = mysql_query($dropdown);

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
                            <th>Order Name</th>
                            <th>Status</th>
                            <th style="width:15%;">Options</th>
                        </tr>
                    </thead>
                </table>
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->      
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        
        <form class="form-horizontal" id="" action="php_action/o_process.php" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Order</h4>
          </div>
          <div class="modal-body">

            <div id="add-brand-messages"></div>

              <div class="form-group">
                              <label for="branch_id" class="col-md-4 control-label">Branch Name</label>
                               
                              <div class="col-md-6">
                                  
                                <select name="branch_id" class="form-control">
                                     <option>Select Branch</option>
                                    <?php
                                    while ($row= mysql_fetch_array($result)){
   
                                    ?>

                                    <option value="<?php echo $row['branch_id'];?>"><?php echo $row['name']; ?> </option>
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
<div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog">
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
                </div> <!-- /form-group-->                      
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
                </div> <!-- /form-group-->  
              </div>                    
              <!-- /edit brand result -->

          </div> <!-- /modal-body -->
          
          <div class="modal-footer editBrandFooter">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
            
            <button type="submit" class="btn btn-success" id="editBrandBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
          </div>
          <!-- /modal-footer -->
        </form>
         <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit brand -->

<!-- remove brand -->
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
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove brand -->
<script src="custom/js/brand.js"></script>
<?php include 'includes/footer.php';   ?>
