<?php //require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="dashboard.php">Home</a></li>         
            <li class="active">Items</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Items</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" 
                            data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add ITEM </button>
                </div> <!-- /div-action -->             

                <table class="table" id="manageProductTable">
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
                            $i=1;
                            $get_id =$_GET['vend_id'];
                            $sql = "SELECT product.name as pname, purchase.qntty, purchase.unit_price,purchase.total_price,purchase.puchase_date
                                    FROM product
                                    INNER JOIN vendor
                                    ON vendor.vendor_id = product.vendor_id
                                    INNER JOIN purchase
                                    ON product.product_id = purchase.product_id
                                    WHERE product.vendor_id = '$get_id'
                                    ";
                           
                            $result = mysql_query($sql);
                            while ($row = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                 <td><?php echo $i++ ?></td>
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
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->      
    </div> <!-- /col-md-12 -->
</div>  <!-- /row -->


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
                    <select name="vendor_id" id="vendor_id" class="form-control">
                                      
                                        <?php
                                        //require 'connection.php';
                                        $get_id =$_GET['vend_id'];
                                        $sql = "SELECT * FROM vendor WHERE vendor_id ='$get_id'";
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
                            <input type="text" class="form-control" id="endDate" name="date" placeholder="Date" required/>
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
<!-- /add categories -->


<!-- edit categories brand -->
<!--<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Items</h4>
              </div>
              <div class="modal-body" style="max-height:450px; overflow:auto;">

                <div class="div-loading">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                                <span class="sr-only">Loading...</span>
                </div>

                <div class="div-result">

                                   Nav tabs 
                                  <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
                                    <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Item Info</a></li>    
                                  </ul>

                                   Tab panes 
                                  <div class="tab-content">

                                        
                                    <div role="tabpanel" class="tab-pane active" id="photo">
                                        <form action="php_action/editProductImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">

                                        <br />
                                        <div id="edit-productPhoto-messages"></div>

                                        <div class="form-group">
                                        <label for="editProductImage" class="col-sm-3 control-label">Item Image: </label>
                                        <label class="col-sm-1 control-label">: </label>
                                                    <div class="col-sm-8">                                                 
                                                      <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
                                                    </div>
                                </div>  /form-group                            
                                        
                                <div class="form-group">
                                        <label for="editProductImage" class="col-sm-3 control-label">Select Photo: </label>
                                        <label class="col-sm-1 control-label">: </label>
                                                    <div class="col-sm-8">
                                                             the avatar markup 
                                                                        <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>                          
                                                            <div class="kv-avatar center-block">                            
                                                                <input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;"/>
                                                            </div>
                                                      
                                                    </div>
                                </div>  /form-group                            

                                <div class="modal-footer editProductPhotoFooter">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                                        
                                         <button type="submit" class="btn btn-success" id="editProductImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> 
                                      </div>
                                       /modal-footer 
                                      </form>
                                       /form 
                                    </div>
                                     product image 
                                    <div role="tabpanel" class="tab-pane" id="productInfo">
                                        <form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST">                   
                                        <br />

                                        <div id="edit-product-messages"></div>

                                        <div class="form-group">
                                        <label for="editProductName" class="col-sm-3 control-label">Item Name: </label>
                                        <label class="col-sm-1 control-label">: </label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
                                                    </div>
                                </div>  /form-group     

                                <div class="form-group">
                                        <label for="editQuantity" class="col-sm-3 control-label">Quantity: </label>
                                        <label class="col-sm-1 control-label">: </label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
                                                    </div>
                                </div>  /form-group              

                                <div class="form-group">
                                        <label for="editRate" class="col-sm-3 control-label">Rate: </label>
                                        <label class="col-sm-1 control-label">: </label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" id="editRate" placeholder="Rate" name="editRate" autocomplete="off">
                                                    </div>
                                </div>  /form-group                 

                                <div class="form-group">
                                        <label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
                                        <label class="col-sm-1 control-label">: </label>
                                                    <div class="col-sm-8">
                                                      <select class="form-control" id="editBrandName" name="editBrandName">
                                                        <option value="">~~SELECT~~</option>
<?php
//$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
//$result = $connect->query($sql);
//
//while ($row = $result->fetch_array()) {
//    echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
//} // while
?>
                                                      </select>
                                                    </div>
                                </div>  /form-group 

                                <div class="form-group">
                                        <label for="editCategoryName" class="col-sm-3 control-label">Category Name: </label>
                                        <label class="col-sm-1 control-label">: </label>
                                                    <div class="col-sm-8">
                                                      <select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
                                                        <option value="">~~SELECT~~</option>
<?php
//$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
//$result = $connect->query($sql);
//
//while ($row = $result->fetch_array()) {
//    echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
//} // while
?>
                                                      </select>
                                                    </div>
                                </div>  /form-group                                                

                                <div class="form-group">
                                        <label for="editProductStatus" class="col-sm-3 control-label">Status: </label>
                                        <label class="col-sm-1 control-label">: </label>
                                                    <div class="col-sm-8">
                                                      <select class="form-control" id="editProductStatus" name="editProductStatus">
                                                        <option value="">~~SELECT~~</option>
                                                        <option value="1">Available</option>
                                                        <option value="2">Not Available</option>
                                                      </select>
                                                    </div>
                                </div>  /form-group                     

                                <div class="modal-footer editProductFooter">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                                        
                                        <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                                      </div>  /modal-footer                      
                                </form>  /.form                         
                                    </div>    
                                     /product info 
                                  </div>

                                </div>
                
              </div>  /modal-body 
                      
        
    </div>
     /modal-content 
  </div>
   /modal-dailog 
</div>-->
<!-- /categories brand -->

<!-- categories brand -->
<!--<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Item</h4>
      </div>
      <div class="modal-body">

        <div class="removeProductMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div> /.modal-content 
  </div> /.modal-dialog 
</div> /.modal -->
<!-- /categories brand -->

    <!--<script type="text/javascript" src="jquery.autocomplete.js"></script>-->
<!--<script src="custom/js/product.js"></script>-->
<script src="custom/js/report.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#manageProductTable').dataTable();
    });
</script>
<!--<script>
    $(document).ready(function () {
        $("#product_name").autocomplete("php_action/autolcomplete_product.php", {
            selectFirst: true
        });
    });
</script>-->
<script>
    $('#qty,#unit_price').change(function () {
        var qty = parseFloat($('#qty').val()) || 0;
        var unit_price = parseFloat($('#unit_price').val()) || 0;
        $('#price').val(qty * unit_price);
    });
</script>

<script>
    /*  jQuery ready function. Specify a function to execute when the DOM is fully loaded.  */
    $(document).ready(
            /* This is the function that will get executed after the DOM is fully loaded */
            $(function(){

            $('#datepicker').DataTable({
            responsive: true
            });
            });
</script>
<?php require_once 'includes/footer.php'; ?>