
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

$table = 'tbl_purchases';
$table2 = 'tbl_purchasedetail';
$table3 = 'tbl_product';
$filter = 'group_no';

?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<?php
$p_id = $_GET['id'];

?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

          
            <div class="box">
          
              <div class="box-header with-border">
                <h3 class="box-title">Purchase Details </h3>
                <div class="box-tools pull-right">
                  <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                  <?php 
                $sqlResult = $db->select('tbl_purchases.*,tbl_supplier.sup_name', $table, 'INNER JOIN tbl_supplier ON tbl_supplier.sup_no = tbl_purchases.sup_no WHERE tbl_purchases.purchase_id="'.$p_id.'"');
                $data = $sqlResult->fetch_assoc();


                  ?>
                    <div class="form-group ">
                      <label>Supplier</label>
                     <h3 class="text-red"><?php echo $data['sup_name']; ?></h3>
                    </div>
                    
                    <div class="form-group ">
                      <label>Invoice Number</label>
                    <h3 class="text-red"><?php echo $data['ref_no']; ?></h3>
                    </div>

                      <div class="form-group ">
                      <label>Invoice Date</label>
                      <h3 class="text-red"><?php echo $data['invoice_date']; ?></h3>
                    </div>
                      
                     
                
                  </div>

                </div><!--/.row-->
              </div><!-- /.box-body -->

          

            
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

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Inventory Adjustment</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
           
            <table id="tbl_groupcredit" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTION</th>
                  <th>Prod No</th>
                  <th>Barcode</th>
                  <th>Prod Name</th>
                  <th>Received Qty</th>
                  <th>Supplier Price</th>
                  <th>Retail Price</th>
                  <th>Wholesale Price</th>
                 
                </tr>
              </thead>
              <tbody>                      
                <?php 
                $sqlResult1 = $db->select('pd_id,prod_no,qty_delivered,retail_price,wholesale_price,supplier_price', $table2, ' WHERE purchase_id="'.$p_id.'"');
               while( $data1 = $sqlResult1->fetch_assoc()){
                $prod_no = $data1['prod_no'];
                $qty_delivered = $data1['qty_delivered'];
                $retail_price = $data1['retail_price'];  
                $wholesale_price = $data1['wholesale_price'];
                $supplier_price = $data1['supplier_price'];
                   
                   $sqlResult2 = $db->select('prod_no,barcode,prod_name', $table3, ' WHERE prod_no="'.$prod_no.'"');
              while ($dataAttri = $sqlResult2->fetch_assoc()) {
                  ?>
                  <tr>
                    <td> 
                     <a href="/akempco/modify-PD.php?pd_id=<?php echo $data1['pd_id']; ?>&prod_id=<?php echo $prod_no; ?>&purchase_id=<?php echo $p_id ;?>">Modify</a>
                      </td>
                      <td><?php echo $prod_no;?></td>
                      <td><?php echo $dataAttri['barcode'];?></td>
                      <td><?php echo $dataAttri['prod_name'];?></td>
                      <td align="right"><?php echo $qty_delivered;?></td>
                      <td align="right"><?php echo number_format($supplier_price, 2, ".", ",");?></td>
                      <td align="right"><?php echo number_format($retail_price, 2, ".", ",");?></td>
                      <td align="right"><?php echo number_format($wholesale_price, 2, ".", ",");?></td>
                      
                     
                    </tr>
                    <?php
               }
               }
                  ?>
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box --> 
        </div>
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- =============================================== -->

  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
  ?>
