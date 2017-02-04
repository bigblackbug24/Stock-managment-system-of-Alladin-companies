<?php require_once 'includes/header.php'; ?>


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
                             <th>Next</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php  
                            $i=1;
                              $id =$_GET['comp_id'];                       
                            $get_id = "SELECT company.company_name as cname, vendor.name, vendor.vendor_id as V_ID, vendor.email,vendor.contact_no,vendor.address
                                    FROM company
                                    INNER JOIN vendor
                                    ON company.company_id=vendor.company_id 
                                    where company.company_id = '$id'";
                            $result = mysql_query($get_id);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                        <tr>
                        <td><?php echo $i++;?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['cname'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['contact_no'];?></td>
                            <td><?php echo $row['address'];?></td>
                            <td><a href="link_product.php?vend_id=<?php echo $row['V_ID'] ?>"><button class="btn btn-success">Add Product</button></td>
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
                                <select name="company_id" class="form-control" id="company_id" >
                                    
                                    <?php
                                    //require 'connection.php';
                                    $id =$_GET['comp_id']; 
                                    $sql = "SELECT * FROM company WHERE company_id = '$id'";
                                    // echo $sql;
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
   
    <script type="text/javascript">
        $(document).ready(function () {
            $('#manageCategoriesTable').dataTable();
        });
    </script>
    <?php require_once 'includes/footer.php'; ?>