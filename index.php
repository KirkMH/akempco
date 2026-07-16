<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
?>
      <!-- =============================================== -->

    <script language = "javascript">

    var myOptions = {
      title: {
          text: "Summary of Sales for the Past Six Months"
      },
              animationEnabled: true,
      data: [
      {
      type: "line", //change it to line, area, bar, pie, etc
        dataPoints: [
          <?php
            $yr_e = date('Y');
            $mo_e = date('m');
            $mo_s = $mo_e - 6;
            $yr_s = $yr_e;
            if ($mo_s < 1) {
              $mo_s = 12 - $mo_s;
              $yr_s = $yr_e - 1;
            }
              

            $start = new DateTime($yr_s."-".($mo_s));
            $end = new DateTime($yr_e."-".$mo_e+1);
            $interval = DateInterval::createFromDateString('1 month');

            $period = new DatePeriod($start, $interval, $end);
            foreach ( $period as $dt ) {

              $filter = "Month(tbl_sales.timestamp) = ".$dt->format('m')." AND Year(tbl_sales.timestamp) = ".$dt->format('Y') . " AND cancelled=0";
              //echo $filter;
              $sqlResult = $db->select_one('SUM(grand_total) AS total', 'tbl_sales', "WHERE $filter");
              ?>

                {label: "<?php echo $dt->format('Y-m');?>", y: <?php echo $sqlResult['total'] > 0 ? $sqlResult['total'] : 0; ?> },
              
            <?php } ?>

              ]
          }
          ]
      };

    </script>      
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 

          <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Summary of Sales</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
              </div>

              <div class="box-body" style="height:500px">
                <div id="resizable" class="col-md-12" >
                  <div id="chartContainer1" style="height: 100%; width: 100%;"></div>
                </div>
              </div>
          </div>

          <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Number of Sold Products</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
              </div>

              <div class="box-body">
                <table id="listTable" class="sorttable table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Barcode</th>
                      <th>Product Name</th>
                      <th>Quantity Sold Since Last Count</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sqlResult = $db->select("barcode, prod_name, qty_sold", "tbl_product", 'WHERE active = 1 ORDER BY qty_sold DESC');
                    if($sqlResult){
                      while ($dataAttri = $sqlResult->fetch_assoc()) {
                        ?>
                        <tr>
                           <td><?php echo ucfirst($dataAttri['barcode']);?></td>
                           <td><?php echo ucfirst($dataAttri['prod_name']);?></td>
                           <td align="center"><?php echo ($dataAttri['qty_sold']);?></td>
                         </tr>
                         <?php
                       }
                     }
                     ?>
                   </tbody>
                 </table>
              </div>
          </div>

      </div>
    </div>
  </section>


</div><!-- /.content-wrapper -->
      

	<!-- =============================================== -->
<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
