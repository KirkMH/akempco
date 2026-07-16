<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $token = Token::generate();
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
              <h3 class="box-title">Summary of Sales Per Member</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="listTable" class="sorttable table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>SI No.</th>
                      <th>Amount</th>
                      <th>payment Type</th>
                      <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sqlResult2 = $db->select('TS.SI_no, TS.grand_total, TS.customer_no, TP.paymentType, TP.amount, TS.timestamp', "tbl_sales AS TS" , "LEFT JOIN tbl_payment AS TP ON TS.SI_no = TP.SI_no WHERE TS.customer_type = 'm' AND timestamp >= now()-interval 3 month");
                    if($sqlResult2){
                      while ($dataAttri = $sqlResult2->fetch_assoc()) {
                  ?>
                        <tr>
                          <td><?php echo $dataAttri['customer_no'] ?></td>
                          <td><?php echo $dataAttri['amount'];?></td>
                          <td><?php echo $dataAttri['paymentType'];?></td>
                          <td><?php echo date('Y-m-d ', strtotime($dataAttri['timestamp'])); ?></td>
                        </tr>
                  <?php
                      }
                   }
                  ?>
                 </tbody>
               </table>
             </div><!-- /.box-body -->
           </div><!-- /.box -->              
         </div><!--/.col-md-12  -->


       </div>  
     </div><!-- row-->
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->

 <?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
 ?>
