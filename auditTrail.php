
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'audit_tbl';

  $filter = 'audit_no';
$audit_no =0;

if (isset($_GET['type']))
  $type = Input::get('type');
else
  $type = 1;
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
            <h3 class="box-title"><?php echo $type == 1 ?  "Inventory Audit Trail" : "POS Audit Trail"; ?></h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->


          <div class="box-body">
            <form method="creditPayment.php" method="get">
            <div class="col-md-5 form-group">
              <label>Audit Trail Source</label>
              <select required class="form-control" name="type" id="type" > <!--onchange="reloadWith();"-->
                <option <?php echo $type == '1' ? 'selected="selected"' : '';?> value="1">Inventory</option>
                <option <?php echo $type == '0' ? 'selected="selected"' : '';?> value="0">Point of Sale</option>
              </select>
            </div>
            <div class="box-footer"> 
              <div class="form-group pull-right">
                <div class="col-md-5 input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-info" type="submit" >Set</button>
                  </span>
               </div><!-- /input-group -->
              </div> <!-- /.form-group -->                 
            </div> <!-- /.box-footer-->
          </form> 
        </div>

          <div class="box-body">
            <table id="listTable" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>User</th>
                  <th>Action</th>
                <?php if ($type == 1) { ?>
                  <th>Table Affected</th>
                  <th>Field Specification</th>
                  <th>Date</th>
                  <th>Time</th>
                <?php } else { ?>
                  <th>Reference</th>
                  <th>Time Stamp</th>
                <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php

// SELECT PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name
// FROM `tbl_product` AS PR
// LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no
// LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no

                // $sqlResult = $db->select('PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name, PR.active', 'tbl_product AS PR', 'LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no');
             $tbl = $type ? "audit_tbl" : "tbl_audittrail";
             $pk =  $type ? "audit_no" : "at_no";
             $userNo =  $type ? "user" : "user_no";
             $fld =  $type ? "table_name, fieldspec, date, time " : "reference, timestamp ";
             $sqlResult = $db->select("(SELECT fullname FROM tbl_useracct WHERE user_no = $tbl.$userNo) AS user, action, $fld", $tbl, "ORDER BY $pk DESC");

                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  //$dataID = $dataAttri['prod_no'];
                  ?>
                  <tr>
                     <td><?php echo $dataAttri['user'];?></td>
                     <td><?php echo $dataAttri['action'];?></td>

                      <?php if ($type == 1) { ?>
                        <td><?php echo $dataAttri['table_name'];?></td>
                        <td><?php echo $dataAttri['fieldspec'];?></td>
                        <td><?php echo $dataAttri['date'];?></td>
                        <td><?php echo $dataAttri['time'];?></td>
                      <?php } else { ?>
                        <td><?php echo $dataAttri['reference'];?></td>
                        <td><?php echo $dataAttri['timestamp'];?></td>
                      <?php } ?>
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

 <!-- =============================================== -->
 
<script language="javascript">
function reloadWith() {
  var no;
  var no = document.getElementById('type').value;
  if (no == "") {
    alert("Please select source of audit trail first.");
  }
  else {
    window.location.href = "auditTrail.php?type=".concat(no);
  }
}
</script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>