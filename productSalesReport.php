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
                      <h3 class="box-title"> Product Sales Report</h3>
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

                  $forExport[1] = array("Date", "Barcode", "Product Name", "Unit Price", "Quantity Sold", "Type of Sale", "Total Sold");
                  ?>
                  </th>
                  <th>Barcode</th>
                  <th>Product Name</th>
                  <th>Unit Price</th>
                  <th>Quantity Sold</th>
		              <th>Type of Sale</th>
                  <th>Total Sold</th>
                </tr>
              </thead>
              <tbody>
                <?php

                // $sqlResult = $db->select('PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name, PR.active', 'tbl_product AS PR', 'LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no');
            $begin = new DateTime( Input::get('dateFrom') );
            $end = new DateTime( Input::get('dateTo') );

            if (Input::get('rptType') == 1) {
              $interval = DateInterval::createFromDateString('1 day');
              #echo "1 day";
            }
            else if (Input::get('rptType') == 2) {
              $interval = DateInterval::createFromDateString('1 month');
              #echo "1 month";
            }
            else {
              $interval = DateInterval::createFromDateString('1 year');
              #echo "1 year";
            }
            
            $period = new DatePeriod($begin, $interval, date_add($end, $interval));



                $total = 0;
            foreach ( $period as $dt ) {

//SELECT (SELECT prod_name FROM tbl_product WHERE tbl_product.prod_no = tbl_soldproducts.prod_no) AS prod_name, uprice, SUM(qty) AS qtySold, (uprice*SUM(qty)) AS totalSales FROM tbl_soldproducts WHERE SI_no IN (SELECT SI_no FROM tbl_sales WHERE Date(tbl_sales.timestamp) = '2016-08-05') GROUP BY prod_no, uprice            
                // $myDate = $dt->format('Y-m-d');
                // $filter = "Date(tbl_sales.timestamp)";

                  $filter = "Date(tbl_sales.timestamp) = '".$dt->format('Y-m-d')."'";

                if (Input::get('rptType') == 1) {
                  // $myDate = $dt->format('Y-m-d');
                  $filter = "Date(tbl_sales.timestamp) = '".$dt->format('Y-m-d')."'";
                }
                else if (Input::get('rptType') == 2) {
                  // $myDate = $dt->format('m');
                  $filter = "Month(tbl_sales.timestamp) = '".$dt->format('m')."' AND Year(tbl_sales.timestamp) = '".$dt->format('Y')."'";
                }
                else {
                  // $myDate = $dt->format('Y');
                  $filter = "Year(tbl_sales.timestamp) = '".$dt->format('Y')."'";
                }

                // echo "(SELECT prod_name FROM tbl_product WHERE tbl_product.prod_no = tbl_soldproducts.prod_no) AS prod_name, ".
                //   "uprice, SUM(qty) AS qtySold, (uprice*SUM(qty)) AS totalSales ", 'tbl_soldproducts', 
                //   "WHERE SI_no IN (SELECT SI_no FROM tbl_sales WHERE $filter = '".$myDate."') GROUP BY prod_no, uprice ORDER BY prod_name";
                $sqlResult = $db->select("(SELECT prod_name FROM tbl_product WHERE tbl_product.prod_no = tbl_soldproducts.prod_no) AS prod_name, ".
                  "(SELECT barcode FROM tbl_product WHERE tbl_product.prod_no = tbl_soldproducts.prod_no) AS barcode, ".
                  "uom, uprice, SUM(qty) AS qtySold, (uprice*SUM(qty)) AS totalSales ", 'tbl_soldproducts', 
                  "WHERE SI_no IN (SELECT SI_no FROM tbl_sales WHERE cancelled = 0 AND $filter) GROUP BY prod_no, uom, uprice ORDER BY prod_name");

                $i = 2;
                $dDt = "";
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  ?>
                  <tr> 
                     <td>
                      <?php 
                      if (Input::get('rptType') == 1) {
                        echo $dt->format('Y-m-d');
                        $dDt = $dt->format('Y-m-d');
                      }
                      else if (Input::get('rptType') == 2) {
                        echo $dt->format('Y-m');
                        $dDt = $dt->format('Y-m');
                      }
                      else {
                        echo $dt->format('Y');
                        $dDt = $dt->format('Y');
                      }
                      ?>
                      
                     <td><?php echo $dataAttri['barcode'];?></td>
                     <td><?php echo $dataAttri['prod_name'];?></td>
		     <td align="right"><?php echo number_format($dataAttri['uprice'], 2, ".", ",");?></td>
                     <td align="right"><?php echo $dataAttri['qtySold'];?></td>
		     <td align="center"><?php echo $dataAttri['uom'];?></td>
                     <td align="right"><?php echo number_format($dataAttri['totalSales'], 2, ".", ",");?></td>
                   </tr>
                 <?php  
                    $total = $total + $dataAttri['totalSales'];
                    $forExport[$i] = array($dDt, $dataAttri['barcode'], $dataAttri['prod_name'], $dataAttri['uprice'], $dataAttri['qtySold'], $dataAttri['uom'], $dataAttri['totalSales']);
                    $i = $i + 1;
                 }
               }
              ?>
               </tbody>
             </table>

             <h3 class="text-red">Total Sales:  P <?php echo number_format($total, 2, ".", ","); ?></h3>
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
