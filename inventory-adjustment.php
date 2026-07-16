<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_product';
  $filter = 'prod_no';

  $strarr = Input::get('which');
/*
  if (!isset($_SESSION)) {
    session_start();
  }
  $arr = $_SESSION['upProd'];
  $i = 0;
  echo count($arr);
  for ($i=1; $i < count($arr); $i=$i+1) {
    echo $i;
    $strarr = $strarr . $arr[$i];
    if ($i + 1 < count($arr) && $arr[$i] !== "") {
      $strarr = $strarr . ", ";
    }
  }*/
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
            <h3 class="box-title">Inventory Count</h3>
            <div class="box-tools pull-right">
              <h4><a href="download.php?what=inventoryCount&which=<?php echo $strarr;?>">Export to CSV</a></h4>
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
                  <th>Actual Count</th>
                  <th>Variance</th>
                </tr>
              </thead>
              <tbody>
                <?php

// SELECT PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name
// FROM `tbl_product` AS PR
// LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no
// LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no

                // $sqlResult = $db->select('PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name, PR.active', 'tbl_product AS PR', 'LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no');
             #echo 'prod_no, prod_name, short_name, (SELECT SUM(qty_onhand) AS onhand FROM tbl_purchasedetail WHERE prod_no=tbl_product.prod_no) AS on_hand, actual_count' . '\ntbl_product' . '\nWHERE active=1 AND package = 0 AND prod_no IN ('.$strarr.')';
             $sqlResult = $db->select('prod_no, prod_name, short_name, (SELECT SUM(qty_onhand) AS onhand FROM tbl_purchasedetail WHERE prod_no=tbl_product.prod_no) AS on_hand, actual_count', 'tbl_product', 'WHERE active=1 AND package = 0 AND prod_no IN ('.$strarr.')');
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['prod_no'];
                  $vari = ($dataAttri['actual_count']-$dataAttri['on_hand']);
                  ?>
                  <tr>
                     <td><?php echo $dataAttri['prod_name'];?></td>
                     <td><?php echo $dataAttri['short_name'];?></td>
                     <td align="center"><?php echo $dataAttri['on_hand'];?></td>
                     <td align="center"><?php echo $dataAttri['actual_count'];?></td>
                     <td align="center"><?php echo $vari;?></td>
                   </tr>
                 <?php
                    # update tbl_product
                    $data = array();
                    $data['qty_begin'] = $dataAttri['actual_count'];
                    $data['variance'] = $vari;
                    $data['qty_delivered'] = 0;
                    $data['qty_sold'] = 0;

                    if ($db->update($table, $data , "WHERE {$filter} = '$dataID'")) {
                    }
                    else 
                          Session::flash('err', "Error accessing product records.");

                    # update tbl_inventorycount
                    $data2 = array(
                      'dmonth' => Input::get('dmonth'),
                      'dyear' => Input::get('dyear'),
                      'prod_no' => $dataAttri['prod_no'],
                      'prod_name' => $dataAttri['prod_name'],
                      'short_name' => $dataAttri['short_name'],
                      'on_hand' => $dataAttri['on_hand'],
                      'actual' => $dataAttri['actual_count'],
                      'variance' => $vari
                      );

                    if ($db->insert('tbl_inventorycount', $data2)) {

                    } else {
                          Session::flash('msg', "Error saving inventory count.");
                    }
                    
                    if ($vari !== 0) {
                      #update onhand based on variance
                      $onhands = $db->select("pd_id, purchase_id, qty_onhand", "tbl_purchasedetail", "WHERE prod_no=$dataID AND qty_onhand>0 ORDER BY pd_id ASC");
                      $oh = 0;
                      while ($prod = $onhands->fetch_assoc()) {
                        $pd_id = $prod['pd_id'];
                        $purchase_id = $prod['purchase_id'];
                        $qty_onhand = $prod['qty_onhand'];


                        if ($vari < 0) {
                          # negative; deduct from system inventory
                          $oh = $qty_onhand + $vari;
                          if ($oh < 0) {
                            $vari = $oh;
                            $oh = 0;
                          }
                          else {
                            $vari = 0;
                          }
                        }
                        else {
                          # positive; add to system inventory
                          $oh = $qty_onhand + $vari;
                          $vari = 0;
                        }


                        $ar = array('qty_onhand' => $oh );
                        $db->update("tbl_purchasedetail", $ar, "WHERE pd_id=".$prod['pd_id']);

                        if ($vari == 0) break;
                      }
                    }
                 }
                 ?>
               </tbody>
             </table>
           </div><!-- /.box-body -->
         </div><!-- /.box -->  


            <!-- <div class="box-footer"> -->
              <!-- <div class="form-group pull-right"> -->
                <!-- <div class="col-lg-5 input-group"> -->
                  <!-- <span class="input-group-btn"> -->
                    <!-- <button class="btn btn-info" type="submit" name="submit" >Save</button> -->
                  <!-- </span> -->
                <!-- </div> --><!-- /input-group -->
              <!-- </div> --><!-- /.form-group -->                 
            <!-- </div> --><!-- /.box-footer-->
          <!-- </form> -->
        </div>


     </div>
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
