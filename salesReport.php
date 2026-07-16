<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

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
              <!-- Default box -->
              <div class="box">
                <form action="salesReport.php" method="get">
                  
                    <div class="box-header with-border">
                      <h3 class="box-title"> Sales Report</h3>
                      <div class="box-tools pull-right">
                        <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>

                    <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">

                            <div class="form-group">
                              <label>Report Type:</label>
                              <div class="input-group">
                                <select required class="form-control" name="rptType">
                                  <option <?php echo (Input::get("rptType") == 1 ? "selected='selected'" : ""); ?> value="1">Daily</option>
                                  <option <?php echo (Input::get("rptType") == 2 ? "selected='selected'" : ""); ?>  value="2">Monthly</option>
                                  <option <?php echo (Input::get("rptType") == 3 ? "selected='selected'" : ""); ?>  value="3">Annual</option>
                                </select>
                              </div><!-- /.input group -->
                            </div>

                            <div class="form-group">
                              <label>Date range:</label>
                              <div class="input-group">
                                <input required class="datepicker" type="date" name="dateFrom" id="dateFrom" value="<?php echo Input::get('dateFrom'); ?>"> to <input required class="datepicker" type="date" name="dateTo" id="dateTo" value="<?php echo Input::get('dateTo'); ?>">
                              </div><!-- /.input group -->
                            </div>

                            <div class="form-group ">
                                <span class="input-group-btn">
                                  <button class="btn btn-info" type="submit" name="dateRangeButton" value="Generate">Generate</button>
                                </span>
                            </div><!-- /.form-group -->  
                        </div>
                      </div><!--/.row-->
                    </div><!-- /.box-body -->

                    <div class="box-footer">
             
                    </div><!-- /.box-footer-->

                </form>
              </div><!-- /.box -->

<?php if (Input::get('dateRangeButton')) { 
?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Generated Sales Report</h3>
            <div class="box-tools pull-right">
              <h4><a href="download.php?what=salesReport">Export to CSV</a></h4>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="listTable" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>
                  <?php 
                  if (Input::get('rptType') == 1) {
                    echo "Date";
                    $forExport[0] = "Daily Sales Report";
                  }
                  else if (Input::get('rptType') == 2) {
                    echo "Month";
                    $forExport[0] = "Monthly Sales Report";
                  }
                  else {
                    echo "Year";
                    $forExport[0] = "Annual Sales Report";
                  }

                  $forExport[1] = array("Date", "Cash Sales", "Charged Sales", "Check Sales", "GC Sales", "Total");
                  ?>
                  </th>
                  <th>Cash Sales</th>
                  <th>Charged Sales</th>
                  <th>Check Sales</th>
                  <th>GC Sales</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php

            $begin = new DateTime( Input::get('dateFrom') );
            $end = new DateTime( Input::get('dateTo') );

            if (Input::get('rptType') == 1) {
              $interval = DateInterval::createFromDateString('1 day');
            }
            else if (Input::get('rptType') == 2) {
              $interval = DateInterval::createFromDateString('1 month');
            }
            else {
              $interval = DateInterval::createFromDateString('1 year');
            }
            
            $period = new DatePeriod($begin, $interval, date_add($end, $interval));

                $grandCash = 0;
                $grandCharge = 0;
                $grandCheck = 0;
                $grandGC = 0;
                $grandTotal = 0;
                $i = 2;

            foreach ( $period as $dt ) {

                // Build the date filter based on report type
                if (Input::get('rptType') == 1) {
                  $filter = "Date(tbl_sales.timestamp) = '".$dt->format('Y-m-d')."'";
                }
                else if (Input::get('rptType') == 2) {
                  $filter = "Month(tbl_sales.timestamp) = '".$dt->format('m')."' AND Year(tbl_sales.timestamp) = '".$dt->format('Y')."'";
                }
                else {
                  $filter = "Year(tbl_sales.timestamp) = '".$dt->format('Y')."'";
                }

                // Query each payment type using SUM from tbl_payment joined with tbl_sales
                $cashResult = $db->select_one(
                  "COALESCE(SUM(p.amount), 0) AS total",
                  "tbl_payment p INNER JOIN tbl_sales s ON p.SI_no = s.SI_no",
                  "WHERE s.cancelled = 0 AND p.paymentType = 'Cash' AND $filter"
                );

                $chargeResult = $db->select_one(
                  "COALESCE(SUM(p.amount), 0) AS total",
                  "tbl_payment p INNER JOIN tbl_sales s ON p.SI_no = s.SI_no",
                  "WHERE s.cancelled = 0 AND p.paymentType = 'Charge' AND $filter"
                );

                $checkResult = $db->select_one(
                  "COALESCE(SUM(p.amount), 0) AS total",
                  "tbl_payment p INNER JOIN tbl_sales s ON p.SI_no = s.SI_no",
                  "WHERE s.cancelled = 0 AND p.paymentType = 'Check' AND $filter"
                );

                $gcResult = $db->select_one(
                  "COALESCE(SUM(p.amount), 0) AS total",
                  "tbl_payment p INNER JOIN tbl_sales s ON p.SI_no = s.SI_no",
                  "WHERE s.cancelled = 0 AND p.paymentType = 'Gift Cert.' AND $filter"
                );

                $cashAmt = $cashResult ? $cashResult['total'] : 0;
                $chargeAmt = $chargeResult ? $chargeResult['total'] : 0;
                $checkAmt = $checkResult ? $checkResult['total'] : 0;
                $gcAmt = $gcResult ? $gcResult['total'] : 0;
                $rowTotal = $cashAmt + $chargeAmt + $checkAmt + $gcAmt;

                $grandCash += $cashAmt;
                $grandCharge += $chargeAmt;
                $grandCheck += $checkAmt;
                $grandGC += $gcAmt;
                $grandTotal += $rowTotal;

                // Determine the display label
                $dDt = "";
                if (Input::get('rptType') == 1) {
                  $dDt = $dt->format('Y-m-d');
                }
                else if (Input::get('rptType') == 2) {
                  $dDt = $dt->format('Y-m');
                }
                else {
                  $dDt = $dt->format('Y');
                }
                ?>
                  <tr> 
                     <td><?php echo $dDt; ?></td>
                     <td align="right"><?php echo number_format($cashAmt, 2, ".", ","); ?></td>
                     <td align="right"><?php echo number_format($chargeAmt, 2, ".", ","); ?></td>
                     <td align="right"><?php echo number_format($checkAmt, 2, ".", ","); ?></td>
                     <td align="right"><?php echo number_format($gcAmt, 2, ".", ","); ?></td>
                     <td align="right"><?php echo number_format($rowTotal, 2, ".", ","); ?></td>
                   </tr>
                 <?php  
                    $forExport[$i] = array($dDt, $cashAmt, $chargeAmt, $checkAmt, $gcAmt, $rowTotal);
                    $i++;
               }
              ?>
               </tbody>
               <tfoot>
                <tr>
                  <th>Grand Total</th>
                  <th align="right"><?php echo number_format($grandCash, 2, ".", ","); ?></th>
                  <th align="right"><?php echo number_format($grandCharge, 2, ".", ","); ?></th>
                  <th align="right"><?php echo number_format($grandCheck, 2, ".", ","); ?></th>
                  <th align="right"><?php echo number_format($grandGC, 2, ".", ","); ?></th>
                  <th align="right"><?php echo number_format($grandTotal, 2, ".", ","); ?></th>
                </tr>
               </tfoot>
             </table>

             <h3 class="text-red">Total Sales:  P <?php echo number_format($grandTotal, 2, ".", ","); ?></h3>
           </div><!-- /.box-body -->
         </div><!-- /.box -->              

<?php 
  
   $_SESSION['exported'] = $forExport; 
}?>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

  <!-- =============================================== -->

<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
