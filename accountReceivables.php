<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';


  $type = "m";
  if (isset($_GET['ar_type'])) {
    if ($_GET['ar_type'] == "g") {
      $type = "g";
    }
  }
?>
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Collectibles</h3>
              <div class="box-tools pull-right">
                <h4><a href="download.php?what=acctRcv&ar_type=<?php echo (Input::get('ar_type') ? Input::get('ar_type') : "m");?>">Export to CSV</a></h4>
              </div>
            </div>
            <div class="box-body">

                <div class="col-md-6">

                <form action="accountReceivables.php" method="get">
                  <div class="form-group ">
                    <label>Collectibles from </label>
                      <select required class="form-control" name="ar_type" >
                        <option value="" >Select Type</option>
                        <option <?php echo $type == 'm' ? 'selected="selected"' : '' ?> value="m" >Members</option>
                        <option <?php echo $type == 'g' ? 'selected="selected"' : '' ?> value="g" >Group Credits</option>
                      </select>      
                  </div>

                  <div class="form-group pull-right">
                    <div class="col-lg-5 input-group">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-info" type="button"> Display </button>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.form-group -->                 
                </form>
              </div>
            </div>

            <div class="box-body">

                <div class="col-md-12">
              <table id="listTable" class="sorttable table table-bordered table-striped">
                <thead>
                  <tr>
                    <?php 
                      if ($type !== "g") {
                        echo "<th>Barcode</th>\n";
                      }
                      ?>
                    
                    <th><?php echo ($type == "m" ? "Member's Name" : "Group Credit's Name"); ?></th>
                    <th>Total Credit Limit</th>
                    <th>Collectibles</th>
                    <th>Remaining Credit Limit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $cname = ($type == "m" ? "member_name" : "group_name");
                  $ccred = ($type == "m" ? "(credit_limit + extra_credit)" : "credit_limit");
                  $ctble = ($type == "m" ? "tbl_members" : "tbl_groupcredit");
                  $cbarc = ($type == "m" ? "barcode, " : "");
                  
                  $sqlResult = $db->select("$cbarc $cname, $ccred AS climit, charge_total", $ctble, "WHERE active = 1 ORDER BY $cname");
                  if($sqlResult){
                    while ($dataAttri = $sqlResult->fetch_assoc()) {
                      ?>
                      <tr>
                         <?php echo ($type == "m" ? "<td>".$dataAttri['barcode']."</td>" : "");?>
                         <td><?php echo ucfirst($dataAttri[$cname]);?></td>
                         <td align="right"><?php echo number_format(($dataAttri['climit']), 2, ".", ",");?></td>
                         <td align="right"><?php echo number_format(($dataAttri['charge_total']), 2, ".", ",");?></td>
                         <td align="right"><?php echo number_format(($dataAttri['climit']-$dataAttri['charge_total']), 2, ".", ",");?></td>
                       </tr>
                       <?php
                     }
                   }
                   ?>
                 </tbody>
               </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <!-- Footer -->
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      

	<!-- =============================================== -->
<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>