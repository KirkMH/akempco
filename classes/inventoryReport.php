<?php
echo "Here!";

require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
$invFr = Input::get('invFrom');
$sel = "";

 $forExport = array();
 if (!isset($_SESSION)) {
  session_start();
 }
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">


        <div class="box">
          <form action="inventoryReport.php" method="get">
            
              <div class="box-header with-border">
                <h3 class="box-title"> Inventory Report</h3>
                <div class="box-tools pull-right">
                </div>
              </div>

              <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">


                      <div class="form-group">
                        Display Inventory Report as of:
                          <select required class="form-control" name="invFrom">
                            <option <?php echo (Input::get("invFrom") == 'Today' ? "selected='selected'" : ""); ?> value="Today">Today</option>
                            <?php
                            $sqlResult = $db->select_one('*', 'tbl_inventorycount');
                            if ($sqlResult !== null ) {
                              $sqlResult = $db->select('DISTINCT (CONCAT( dmonth,  "/", dyear )) AS my', 'tbl_inventorycount', 'ORDER BY my DESC');
                            
                              while ($dataAttri = $sqlResult->fetch_assoc()) {
                                $chop = split("/", $dataAttri['my']);
                                $dmo = getMonthName($chop[0]);
                                $dYr = $chop[1];
                                if ($invFr == $dataAttri['my']) {
                                  $sel = "$dmo, $dYr";
                                }
                                  
                                echo "<option " . ($invFr == $dataAttri['my'] ? "selected='selected'" : "") . "value='" . $dataAttri['my'] . "'>$dmo, $dYr</option>";
                              }
                            }
                            ?>
                          </select>
                      </div>

                      <div class="form-group ">
                          <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" name="View" value="View">View</button>
                          </span>
                      </div><!-- /.form-group -->  
                  </div>
                </div><!--/.row-->
              </div><!-- /.box-body -->

              <div class="box-footer">
       
              </div><!-- /.box-footer-->

          </form>
        </div><!-- /.box -->

<?php 
$title = "Inventory Report as of " . (($sel == '' || $sel == 'Today') ? "Today" : $sel); 
$forExport[0] = $title;
?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?php echo $title; ?></h3>
            <div class="box-tools pull-right">
              <h4><a href="download.php?what=inventoryReport">Export to CSV</a></h4>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="listTable" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Barcode</th> 
                  <th>Product Name</th>
                  <th>Short Name</th>
                  <th>System Inventory</th>
                  <?php if ($invFr == '' || $invFr == 'Today') { 
                    $forExport[1] = array("Barcode", "Product Name", "Short Name", "System Inventory");
                    ?>
                  <?php } else { 
                    $forExport[1] = array("Barcode", "Product Name", "Short Name", "System Inventory", "Actual Count", "Variance");?>
                    <th>Actual Count</th>
                    <th>Variance</th>
                  <?php } ?> 
                </tr>
              </thead>
              <tbody>
                <?php

//SELECT prod_no, prod_name, short_name, (SELECT SUM(qty_onhand) AS onhand FROM tbl_purchasedetail WHERE prod_no=tbl_product.prod_no) AS qty_onhand FROM tbl_product WHERE active=1
              
              if ($invFr == '' || $invFr == 'Today') {

                $ctr = 2;
                $sqlResult = $db->select('barcode, prod_no, prod_name, short_name, (SELECT SUM(qty_onhand) AS onhand FROM tbl_purchasedetail WHERE prod_no=tbl_product.prod_no) AS qty_onhand', 'tbl_product', 'WHERE active=1 AND package=0');
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['prod_no'];
                  $forExport[$ctr] = array($dataAttri['barcode'], $dataAttri['prod_name'], $dataAttri['short_name'], $dataAttri['qty_onhand']);
                  $ctr = $ctr + 1;
                  ?>
                  <tr>
                     <td><?php echo $dataAttri['barcode'];?></td>
                     <td><?php echo $dataAttri['prod_name'];?></td>
                     <td><?php echo $dataAttri['short_name'];?></td>
                     <td align="center"><?php echo $dataAttri['qty_onhand'];?></td>
                   </tr>
                 <?php  
                 }
               } else {
//echo $invFr;
                #$chop = split('/', $invFr);
                $ctr = 2;
                $sqlResult = $db->select('*', 'tbl_inventorycount', "WHERE concat(dmonth, '/', dyear) = '$invFr'"); #".$chop[0]."/".$chop[1]);
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $res = $db->select_one('barcode', 'tbl_product', "WHERE prod_no = ".$dataAttri['prod_no']); #".$chop[0]."/".$chop[1]);

                  $bcode = ($res !== null) ? $res['barcode'] : "-";
                  $forExport[$ctr] = array($bcode, $dataAttri['prod_name'], $dataAttri['short_name'], $dataAttri['on_hand'], $dataAttri['actual'], $dataAttri['variance']);
                  $ctr = $ctr + 1;
                  ?>

                  <tr>
                     <td><?php echo $bcode;?></td>
                     <td><?php echo $dataAttri['prod_name'];?></td>
                     <td><?php echo $dataAttri['short_name'];?></td>
                     <td align="center"><?php echo $dataAttri['on_hand'];?></td>
                     <td align="center"><?php echo $dataAttri['actual'];?></td>
                     <td align="center"><?php echo $dataAttri['variance'];?></td>
                   </tr>

                 <?php 
                }

               }
               $_SESSION['exported'] = $forExport; 
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
