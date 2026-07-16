<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
?>

<?php
  if (isset($_GET['dateRangeButton'])) { 
    $dateRange = $_GET['dateRangeBox'];
    $selDates = explode(" - ", $dateRange);

    $date = date_create($selDates[0]);
    $date2 = date_create($selDates[1]);?>

    <script language = "javascript">

    var myOptions = {
      title: {
          text: "Sales Report for the dates <?php echo $selDates[0];?> to <?php echo $selDates[1];?>"
      },
              animationEnabled: true,
      data: [
      {
      type: "line", //change it to line, area, bar, pie, etc
        dataPoints: [
          <?php
            while ($date <= $date2) {

              if (Input::get('xtype') == "Daily") {
                $sqlResult = $db->select_one('SUM(grand_total) AS total', 'tbl_sales', "WHERE Date(timestamp) = '" . $date->format('Y-m-d') . "'" );
              }
              else if (Input::get('xtype') == "Monthly") {
                $sqlResult = $db->select_one('SUM(grand_total) AS total', 'tbl_sales', "WHERE MONTH(timestamp) = '" . date("m",strtotime($date->format('Y-m-d'))) . "' AND YEAR(timestamp) = " . date("y",strtotime($date)) );
              }
              else {
                $sqlResult = $db->select_one('SUM(grand_total) AS total', 'tbl_sales', "WHERE YEAR(timestamp) = " . date("y",strtotime($date->format('Y-m-d'))) );
              }
              if($sqlResult && Input::get('xtype') == "Daily"){ ?>

                {label: "<?php echo $date->format('Y-m-d');?>", y: <?php echo $sqlResult['total'] > 0 ? $sqlResult['total'] : 0; ?> },

          <?php
              }
              else if($sqlResult && Input::get('xtype') == "Monthly"){ ?>

                {label: "<?php echo date('m',strtotime($date)).', ', date('y',strtotime($date->format('Y-m-d')));?>", y: <?php echo $sqlResult['total'] > 0 ? $sqlResult['total'] : 0; ?> },

          <?php
              }
              else { ?>

                {label: "<?php echo date('y',strtotime($date->format('Y-m-d')));?>", y: <?php echo $sqlResult['total'] > 0 ? $sqlResult['total'] : 0; ?> },

          <?php
              }
              if (Input::get('xtype') == "Daily") {
                date_add($date, date_interval_create_from_date_string('1 day'));
              }
              else if (Input::get('xtype') == "Daily") {
                date_add($date, date_interval_create_from_date_string('1 month'));
              }
              else {
                date_add($date, date_interval_create_from_date_string('1 year'));
              }
              
            } ?>

              ]
          }
          ]
      };

    </script>
<?php } ?>
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
                              <label for="">Report Type </label>
                              <select required class="form-control" id="xType" name="xType"> 
                                <option value="Daily" >Daily</option>
                                <option value="Monthly" >Monthly</option>
                                <option value="Annually" >Annually</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Date range:</label>
                              <div class="input-group">
                                <input type="date" name="dateFrom" id="dateFrom" > to <input type="date" name="dateTo" id="dateTo" >
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

                </form>
              </div><!-- /.box -->
<?php if(Input::get('dateRangeButton')) { ?>
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
                  <th>Date</th>
                  <!-- <th>Barcode</th> -->
                  <th>Product Name</th>
                  <th>Unit Price</th>
                  <th>Qty Sold</th>
                  <th>Total Sales</th>
                </tr>
              </thead>
              <tbody>
                <?php

// SELECT PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name
// FROM `tbl_product` AS PR
// LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no
// LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no

                // $sqlResult = $db->select('PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name, PR.active', 'tbl_product AS PR', 'LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no');
             $sqlResult = $db->select('*', 'tbl_product', 'WHERE active=1 AND package=0 ORDER BY prod_name');
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['prod_no'];
                  ?>
                  <tr>
                    <td>                      
                      <a href="/akempco/regProductSupplier.php?action=select&page=regProductSupplier.php&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?> ">SUPPLIER</a> |
                      <a href="/akempco/includes/processor.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?> ">UPDATE</a> |  
                      <a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?>&active="  onclick="return (confirm('Are you sure you want to delist this product?'));">DELIST</a>
                    </td>
            
                     <td><?php echo $dataAttri['prod_name'];?></td>
                     <td><?php echo $dataAttri['short_name'];?></td>
                     <td align="right"><?php echo $dataAttri['srprice'];?></td>
                     <td align="right"><?php echo $dataAttri['numWholesale'];?></td>
                     <td><?php echo ($dataAttri['active'] == 1) ?"Yes":"No" ;?></td>
                   </tr>
                 <?php  
                 }
                 ?>
               </tbody>
             </table>
           </div><!-- /.box-body -->
         </div><!-- /.box -->              

              <?php }
// SELECT prod_name, barcode, SUM(qty) AS sold, SUM((qty*uprice)) AS sales
// FROM tbl_product
// INNER JOIN tbl_soldproducts ON tbl_soldproducts.prod_no = tbl_product.prod_no
// INNER JOIN tbl_sales ON tbl_sales.SI_no = tbl_soldproducts.SI_no
// GROUP BY prod_name, barcode
?>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

  <!-- =============================================== -->

<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
