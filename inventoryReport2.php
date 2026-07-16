<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
$table = "tbl_ingredient;"
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Inventory Report</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><a href="inventoryReport2.php">Printer Friendly View</a></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="listTable" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <!-- <th>Barcode</th> -->
                  <th>Product Name</th>
                  <th>Short Name</th>
                  <th>System Inventory</th>
                </tr>
              </thead>
              <tbody>
                <?php

//SELECT prod_no, prod_name, short_name, (SELECT SUM(qty_onhand) AS onhand FROM tbl_purchasedetail WHERE prod_no=tbl_product.prod_no) AS qty_onhand FROM tbl_product WHERE active=1

             $sqlResult = $db->select('prod_no, prod_name, short_name, (SELECT SUM(qty_onhand) AS onhand FROM tbl_purchasedetail WHERE prod_no=tbl_product.prod_no) AS qty_onhand', 'tbl_product', 'WHERE active=1');
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['prod_no'];
                  ?>
                  <tr>
                     <td><?php echo $dataAttri['prod_name'];?></td>
                     <td><?php echo $dataAttri['short_name'];?></td>
                     <td align="right"><?php echo $dataAttri['qty_onhand'];?></td>
                   </tr>
                 <?php  
                 }
                 ?>
               </tbody>
             </table>
           </div><!-- /.box-body -->
         </div><!-- /.box -->  

      </div><!--/.col-md-12  -->

    </div><!-- /.row-->
  </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
