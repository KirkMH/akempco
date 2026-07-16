<?php
$dataID = 0;

if (isset($_GET['dataID'])) {
  $dataID = $_GET['dataID'];
}
else {
  Redirect::to("regProduct.php");
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

          
            <div class="box">
          
              <div class="box-header with-border">
                <h3 class="box-title">Product's Prices </h3>
                <div class="box-tools pull-right">
                  <h5><a href="regProduct.php">View Product List</a></h5>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label>Product Name</label>
                     <h3 class="text-red"><?php echo $_GET['prodName']; ?></h3>
                    </div>
                  </div>

                </div><!--/.row-->
              </div><!-- /.box-body -->

          

            
          </div><!-- /.box -->
          
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">List of Prices</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
           
            <table id="tbl_groupcredit" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <?php if($_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
                  <th>Action</th>
                  <?php } ?>
                  <th>Invoice Date</th>
                  <th>Reference No.</th>
                  <th>Qty Delivered</th>
                  <th>Qty Onhand</th>
                  <th>Retail Price</th>
                  <th>Wholesale Price</th>
                 
                </tr>
              </thead>
              <tbody>                      
                <?php 
                $sqlResult1 = $db->select('pd_id, invoice_date, ref_no, qty_delivered, qty_onhand, retail_price, wholesale_price', 
                  'tbl_purchasedetail', 
                  'INNER JOIN tbl_purchases ON tbl_purchasedetail.purchase_id = tbl_purchases.purchase_id WHERE prod_no='.$dataID);

               while( $data1 = $sqlResult1->fetch_assoc()){
                  if ($data1['qty_onhand'] == 0)
                    continue; ?>
                  <tr>
                      <?php if($_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
                      <td><a href="modify-onhand.php?pd_id=<?php echo $data1['pd_id'];?>">Adjust Onhand</a></td>
                      <?php } 
                      ?>
                      <td><?php echo $data1['invoice_date'];?></td>
                      <td><?php echo $data1['ref_no'];?></td>
                      <td align="right"><?php echo $data1['qty_delivered'];?></td>
                      <td align="right"><?php echo $data1['qty_onhand'];?></td>
                      <td align="right"><?php echo number_format($data1['retail_price'], 2, ".", ",");?></td>
                      <td align="right"><?php echo number_format($data1['wholesale_price'], 2, ".", ",");?></td>
                      
                     
                    </tr>
                    <?php
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
