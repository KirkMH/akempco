
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

$table2 = 'tbl_product';
$table = 'tbl_purchasedetail';
$filter = 'pd_id';


?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<?php
$prod_id = $_GET['prod_id'];
$pd_id = $_GET['pd_id'];
$purchase_id =$_GET['purchase_id'];
?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

          
            <div class="box">
             <form action="/akempco/update_pd.php" method="post" enctype="multipart/form-data">
              <div class="box-header with-border">
                <h3 class="box-title">Purchase Details </h3>
                <div class="box-tools pull-right">
                  <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                <input  value="<?php echo $pd_id; ?>"  type="hidden" class="form-control" name="pd_id" >
                      
                 <input  value="<?php echo $purchase_id; ?>"  type="hidden" class="form-control" name="purchase_id" >
                  <?php 
                $sqlResult = $db->select('barcode,prod_name', $table2, ' WHERE prod_no="'.$prod_id.'"');
                $data = $sqlResult->fetch_assoc();
                    $barcode = $data['barcode'];
                    $prod_name =$data['prod_name'];
                
                $sqlResult2 = $db->select('qty_delivered,retail_price,wholesale_price,supplier_price', $table, ' WHERE pd_id="'.$pd_id.'"');
                    $data1 = $sqlResult2->fetch_assoc();
                    $qty_delivered = $data1['qty_delivered'];
                    $r_price = $data1['retail_price'];
                    $w_price = $data1['wholesale_price'];
                    $s_price = $data1['supplier_price'];


                  ?>
                    <div class="form-group ">
                      <label>Barcode</label>
               <input required value="<?php echo $barcode; ?>"  type="text" class="form-control" name="barcode" id="" placeholder="" disabled>
                    </div>
                    
                    <div class="form-group ">
                      <label>Product Name</label>
                  <input required value="<?php echo $prod_name; ?>"  type="text" class="form-control" name="barcode" id="" placeholder="" disabled>
                    </div>

                      <div class="form-group ">
                      <label>Received Quantity</label>
                <input required value="<?php echo $qty_delivered; ?>"  type="text" class="form-control" name="rqty" id="" placeholder="" >
                    </div>
                      
                     
                
                  </div>
                    <div class="col-md-6">
                   <div class="form-group ">
                      <label>Supplier Price</label>
               <input required value="<?php echo $s_price; ?>"  type="text" class="form-control" name="sprice" id="" placeholder="" >
                    </div>
                    
                    <div class="form-group ">
                      <label>Retail Price</label>
                  <input required value="<?php echo $r_price; ?>"  type="text" class="form-control" name="rprice" id="" placeholder="">
                    </div>

                      <div class="form-group ">
                      <label>Wholesale Price</label>
                <input required value="<?php echo $w_price; ?>"  type="text" class="form-control" name="wprice" id="" placeholder="" >
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
