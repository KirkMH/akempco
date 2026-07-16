
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

$table = 'tbl_purchasedetail';
$filter = 'pd_id';


$pd_id = Input::get('pd_id');
$msg = "";

if (Input::get('submit') == "Save") {

  $data = array(
    'qty_onhand' => Input::get('rqty')
    );

  if ($db->update('tbl_purchasedetail', $data, "WHERE $filter=$pd_id")) {
    $msg = "The quantity on hand has been updated.";
  }
  else {
   $msg = "Updating of record failed."; 
  }
}
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
   
                  <?php 
                    if($msg !== ""){
                  ?>
                    <div class="alert alert-success alert-dismissable">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                      <h4>  <i class="icon fa fa-check"></i> <?php  echo $msg; ?></h4>
                    </div>
                  <?php 
                  }
                  ?>
          
            <div class="box">
             <form action="modify-onhand.php" method="get" >
              <div class="box-header with-border">
                <h3 class="box-title">Adjust Onhand </h3>
                <div class="box-tools pull-right">
                  <h5><a href="regProduct.php">View Product List</a></h5>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <input  value="<?php echo $pd_id; ?>"  type="hidden" class="form-control" name="pd_id" >
                      <?php 
                        $sqlResult = $db->select_one("prod_name, qty_onhand", "tbl_purchasedetail INNER JOIN tbl_product ON tbl_purchasedetail.prod_no = tbl_product.prod_no ", "WHERE pd_id=".$pd_id);
                        $cur_qty = $sqlResult['qty_onhand'];
                        $prod_name =$sqlResult['prod_name'];


                      ?>
                    
                      <div class="form-group ">
                        <label>Product Name</label>
                        <input required value="<?php echo $prod_name; ?>"  type="text" class="form-control" name="barcode" id="" placeholder="" disabled>
                      </div>

                      <div class="form-group ">
                        <label>Current Onhand</label>
                        <input required value="<?php echo $cur_qty; ?>"  type="text" class="form-control" name="rqty" id="" placeholder="" disabled >
                      </div>

                      <div class="form-group ">
                        <label>New Onhand</label>
                        <input required value="<?php echo $cur_qty; ?>"  type="number" min="0" class="form-control" name="rqty" id="" placeholder="" >
                      </div>
                     
                  </div>

                </div><!--/.row-->
              </div><!-- /.box-body -->

            <div class="box-footer">
              <p class="pull-left text-red"><b>All fields are required</b></p>
              <div class="form-group pull-right">
                <div class="col-lg-5 input-group">
                  <span class="input-group-btn">
                    <button class=" btn btn-info" name="submit" type="submit" value="Save">Save</button>
                  </span>
                </div>
              </div>
            </div>
          

                </form>
          </div><!-- /.box -->
          
        <!-- Default box -->
   
<!--
        <div class="box">
          <div class="box-header">
            <h3>Upload CSV file</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div>


          <div class="box-body">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="">Select Action</label> 
                <select class="form-control">
                  <option selected="selected">Select Action</option>
                  <option>Add Bulk Members</option>
                  <option>Update Payment Records</option>
                </select>
              </div>  

              <div class="input-group">
                <input type="file">
              </div>
            </div>
          </div>

          <div class="box-footer">
            <div class="form-group pull-right">
              <div class="col-lg-5 input-group">
                <span class="input-group-btn">
                  <button class="btn btn-info" type="button">Save</button>
                </span>
              </div>
            </div>
          </div>
        </div>
 -->

       
        </div>
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- =============================================== -->

  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
  ?>
