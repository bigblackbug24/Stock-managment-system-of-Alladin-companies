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
            <li class="active">Vendor</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Vendor</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Vendor </button>
                       <button class="btn btn-primary button1"> <i class="glyphicon glyphicon-print"></i><a href="#" value="Print" onclick="agreement_printDiv('print_agreement')" style="color:white;"> Print</a> </button>
                </div> <!-- /div-action -->				

                <table class="table" id="manageCategoriesTable">
                    <thead>
                        <tr>		
                        <th>Sr #</th>					
                            <th>Vendor Name</th>
                            <th>Company Name</th>
                            <th>Vendor Email</th>
                            <th>Vendor Contact No</th>
                            <th>Vendor Address</th>
<!--                            <th>Status</th>
                            <th style="width:15%;">Options</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            $i=1;
                            $sql = "SELECT company.company_name as cname, vendor.name, vendor.email,vendor.contact_no,vendor.address
                                    FROM vendor
                                    INNER JOIN company
                                    ON vendor.company_id=company.company_id";
                                   // $id =$_GET['comp_id'];
                            // $get_id = "SELECT company.company_name as cname, vendor.name, vendor.email,vendor.contact_no,vendor.address
                            //         FROM company
                            //         INNER JOIN vendor
                            //         ON company.company_id=vendor.company_id 
                            //         where company.company_id = '$id'";
                        // if($get_id){
                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                        <tr>
                         <td><?php echo $i++ ?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['cname'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['contact_no'];?></td>
                            <td><?php echo $row['address'];?></td>
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


    <!-- add categories -->
    <div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" action="php_action/save_vendor.php" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Vendor</h4>
                    </div>
                    <div class="modal-body">

                        <div id="add-categories-messages"></div>         	        
                        <div class="form-group">
                            <label for="categoriesStatus" class="col-sm-3 control-label">Company Name: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select name="company_id" class="form-control" id="company_id" title="Conpany name required" required>
                                    <option value="">---- Please Select Company----</option>
                                    <?php
                                    //require 'connection.php';
                                    $sql = "SELECT * FROM company";
                                    //echo $sql;
                                    $result = mysql_query($sql);

                                    while ($row = mysql_fetch_array($result)) {
                                        $comp_id = $row["company_id"];
                                        //print_r($comp_id);
                                        $comp_name = $row["company_name"];
                                        ?>
                                        <option value="<?php echo $comp_id; ?>"><?php echo $comp_name; ?> </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="categoriesName" class="col-sm-3 control-label">Vendor Name: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" autocomplete="off" required>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                        <button type="submit" class="btn btn-primary" id="submit" name="submit" autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                    </div> <!-- /modal-footer -->	      
                </form> <!-- /.form -->	     
            </div> <!-- /modal-content -->    
        </div> <!-- /modal-dailog -->
    </div> 
    <!-- /add categories -->


    <!-- edit categories brand -->
    <!--<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
            
            <form class="form-horizontal" id="editCategoriesForm" action="php_action/editCategories.php" method="POST">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Brand</h4>
                  </div>
                  <div class="modal-body">

                    <div id="edit-categories-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                                                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                                    <span class="sr-only">Loading...</span>
                                            </div>

                          <div class="edit-categories-result">
                            <div class="form-group">
                                    <label for="editCategoriesName" class="col-sm-4 control-label">Categories Name: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                                <div class="col-sm-7">
                                                  <input type="text" class="form-control" id="editCategoriesName" placeholder="Categories Name" name="editCategoriesName" autocomplete="off">
                                                </div>
                            </div>  /form-group	         	        
                            <div class="form-group">
                                    <label for="editCategoriesStatus" class="col-sm-4 control-label">Status: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                                <div class="col-sm-7">
                                                  <select class="form-control" id="editCategoriesStatus" name="editCategoriesStatus">
                                                    <option value="">~~SELECT~~</option>
                                                    <option value="1">Available</option>
                                                    <option value="2">Not Available</option>
                                                  </select>
                                                </div>
                            </div>  /form-group	 
                          </div>         	        
                           /edit brand result 

                  </div>  /modal-body 
                  
                  <div class="modal-footer editCategoriesFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                    
                    <button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                  </div>
                   /modal-footer 
            </form>
                  /.form 
        </div>
         /modal-content 
      </div>
       /modal-dailog 
    </div>
     /categories brand 

     categories brand 
    <div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Brand</h4>
          </div>
          <div class="modal-body">
            <p>Do you really want to remove ?</p>
          </div>
          <div class="modal-footer removeCategoriesFooter">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
            <button type="button" class="btn btn-primary" id="removeCategoriesBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
          </div>
        </div> /.modal-content 
      </div> /.modal-dialog 
    </div> /.modal 
     /categories brand -->
    <!--print vendor form-->
    <div class="row">
         <div class="print_agreement" id="print_agreement" style="display: none;" >
    <div class="col-md-12">

      

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Vendor Details</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

             				

                <table class="table" id="manageCategoriesTable">
                    <thead>
                        <tr>		
                        <th>Sr #</th>					
                            <th>Vendor Name</th>
                            <th>Company Name</th>
                            <th>Vendor Email</th>
                            <th>Vendor Contact No</th>
                            <th>Vendor Address</th>
<!--                            <th>Status</th>
                            <th style="width:15%;">Options</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            $i=1;
                            $sql = "SELECT company.company_name as cname, vendor.name, vendor.email,vendor.contact_no,vendor.address
                                    FROM vendor
                                    INNER JOIN company
                                    ON vendor.company_id=company.company_id";
                                   // $id =$_GET['comp_id'];
                            // $get_id = "SELECT company.company_name as cname, vendor.name, vendor.email,vendor.contact_no,vendor.address
                            //         FROM company
                            //         INNER JOIN vendor
                            //         ON company.company_id=vendor.company_id 
                            //         where company.company_id = '$id'";
                        // if($get_id){
                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                        <tr>
                         <td><?php echo $i++ ?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['cname'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['contact_no'];?></td>
                            <td><?php echo $row['address'];?></td>
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



    <!--<script src="custom/js/categories.js"></script>-->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#manageCategoriesTable').dataTable();
        });
    </script>
    <?php require_once 'includes/footer.php'; ?>