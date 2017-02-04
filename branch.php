<?php include 'includes/header.php';   ?>
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
          <li class="active">Branch</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Branch</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Branch </button>
                      <button class="btn btn-primary button1"> <i class="glyphicon glyphicon-print"></i><a href="#" value="Print" onclick="agreement_printDiv('print_agreement')" style="color:white;"> Print</a> </button>
                </div> <!-- /div-action -->             
                
                <table class="table" id="branchtable">
                    <thead>
                        <tr>     
                         <th>Sr #</th>                       
                            <th>Branch Name</th>
                            <th>Contact</th>
                            <th style="width:15%;">Email</th>
                            <th>Address</th>
                            <th>Department</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                            <?php
                            $i = 1;
                                    $sql = "SELECT * from branches";
                            $result = mysql_query($sql);
                            // $row = mysql_fetch_array($result);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                 <tr>
                                  <td><?php echo $i++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                 <td><?php echo $row['contact_no']; ?></td>
                                   <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                               <td><?php echo $row['departments']; ?></td>
                              
                                
                                <td><a href="link_order.php?bran_id=<?php echo $row['branch_id'] ?>"><button class="btn btn-success">Place Order</button></td>
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
        
        <form class="form-horizontal" id="" action="php_action/register_branch.php" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Branch</h4>
          </div>
          <div class="modal-body">

            <div id="add-brand-messages"></div>

             <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Branch Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required>                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="email" type="address" class="form-control" name="address" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact_no" class="col-md-4 control-label">Contact No</label>
                            <div class="col-md-6">
                                <input id="contact_no" type="text" class="form-control" name="contact_no" required>                           
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                                <select name="depatment_name" id="depatment_name" class="form-control" >
                                    <option value="">----Select Department ---- </option>
                                    <option value="Accounts">Accounts </option>
                                    <option value="IT">IT</option>
                                    <option value="Cash">Cash </option>
                                    <option value="Logistics">Logistics</option>
                                    <option value="Finance">Finance</option>
                                   
                                </select>
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
 <!--print branch details-->
 <div class="row">
      <div class="print_agreement" id="print_agreement" style="display: none;" >
    <div class="col-md-12">

       

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>  Branch Details</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>
        
                
                <table class="table" id="branchtable">
                    <thead>
                        <tr>     
                         <th>Sr #</th>                       
                            <th>Branch Name</th>
                            <th>Contact</th>
                            <th style="width:15%;">Email</th>
                            <th>Address</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                       
                            <?php
                            $i = 1;
                                    $sql = "SELECT * from branches";
                            $result = mysql_query($sql);
                            // $row = mysql_fetch_array($result);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                 <tr>
                                  <td><?php echo $i++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['contact_no']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                              
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
<script src="custom/js/brand.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#branchtable').dataTable();
    });
</script>
<?php include 'includes/footer.php';   ?>
