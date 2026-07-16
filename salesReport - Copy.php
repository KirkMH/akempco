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
                              <label for="">Display </label>
                              <select required class="form-control" id="xType" name="xType"> 
                                <option value="Daily" >Daily</option>
                                <option value="Monthly" >Monthly</option>
                                <option value="Annually" >Annually</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Date range:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="dateRangeBox" name="dateRangeBox" class="form-control pull-right" value="<?php echo (isset($_GET['dateRangeBox']) ? $_GET['dateRangeBox'] : ''); ?>">
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

              <?php 
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
