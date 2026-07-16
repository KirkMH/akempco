<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

  $table = 'tbl_product';
  $filter = 'prod_no';
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
            <h3 class="box-title">Delisted Products</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>                  
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group"><input type="button" onclick="location.href='regProduct.php'" value="View Active Products" /></div>
            <table id="listTable" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTIONS</th>
                  <!-- <th>Barcode</th> -->
                  <th>Product Name</th>
                  <th>Short Name</th>
                  <th>SRP</th>
                  <th>No of Items in Wholesale</th>
                </tr>
              </thead>
              <tbody>
                <?php

// SELECT PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name
// FROM `tbl_product` AS PR
// LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no
// LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no

                // $sqlResult = $db->select('PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name, PR.active', 'tbl_product AS PR', 'LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no');
             $sqlResult = $db->select('*', 'tbl_product', 'WHERE active=0 AND package=0 ORDER BY prod_name');
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['prod_no'];
                  ?>
                  <tr>
                    <td><a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter?>&dataID=<?php echo $dataID; ?>&active=1" onclick="return (confirm('Are you sure you want to restore this product?'));">RESTORE</a></td>
            
                     <td><?php echo $dataAttri['prod_name'];?></td>
                     <td><?php echo $dataAttri['short_name'];?></td>
                     <td align="right"><?php echo $dataAttri['srprice'];?></td>
                     <td align="right"><?php echo $dataAttri['numWholesale'];?></td>
                   </tr>
                 <?php  
                 }
                 ?>
               </tbody>
             </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>  
  </div><!-- row-->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
