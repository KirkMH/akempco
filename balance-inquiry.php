<?php
// session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
// print_r($_SESSION['barcode']);
      // if(!(Input::get('id'))){
      //   Redirect::to('login.php');
      // }

?>
<!-- =============================================== -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAK | MEMBER BALANCE INQUIRY</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php  ?>dist/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="dist/css/addons.css">
  </head>
  <body class="hold-transition login-page">
    <div class="col-md-2">
      <!-- <img src="core/logo50.gif" alt="F1 Logo" class="img-responsive" > -->
    </div>
    <div class="col-md-2 pull-right">
      <!-- <img src="core/logo50.gif" alt="F1 Logo" class="img-responsive" > -->
      
    </div> 



<!-- Content Wrapper. Contains page content -->
<div class="">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <?php 
          $barcode = Input::get('id');

          $sqlResult = $db->select_one("*", "tbl_members", "WHERE barcode = " . $barcode );
          if ($sqlResult) {
            $memberID = $sqlResult['member_no'];
              // $_SESSION['login_member_role'] = $sqlResult['role'];
        ?>
          <!-- Default box -->
            <div class="box">
              <form action="/akempco/includes/processor.php" method="GET">
                <div class="box-header with-border">
                  <h3 class="box-title"> Member Balance Inquiry</h3>
                  <div class="box-tools pull-right">
                    <h4>Welcome
                      <a href="memAccount.php" class="dropdown-toggle" >
                         <?php echo ucfirst($sqlResult['member_name']);?> 
                      </a>|
                      <a class="" href="logout.php">Logout</a></h4>
                  </div>
                </div>

                <div class="box-body" style="">
                <!--background:url('core/logo50.gif') no-repeat center-->
                    <div class="col-md-6">
                          <div class="form-group ">
                            <label>Member Name: <span style="color:#FF5722; font-size:18px"><?php echo ucfirst($sqlResult['member_name']); ?></span></label>
                          </div>
                    </div>
                    <div class="col-md-6">
                          <div class="form-group ">
                            <label>Total Payables: <span style="color:#FF5722; font-size:18px">P <?php echo number_format($sqlResult['charge_total'],2,'.', ','); ?></span></label>
                          </div>
                    </div>
                <div class="col-md-12">
                      <h4>Summary in 3 Months</h4>
                        <h5>Total Paid in CASH: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_members AS TM ON TS.customer_no = TM.member_no WHERE TM.barcode = $barcode AND TP.paymentType = 'Cash' " );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
                        <h5>Total CHARGED: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_members AS TM ON TS.customer_no = TM.member_no WHERE TM.barcode = $barcode AND TP.paymentType = 'Charge' " );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
                        <h5>Total Paid in CHECK: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_members AS TM ON TS.customer_no = TM.member_no WHERE TM.barcode = $barcode AND TP.paymentType = 'Check' " );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
                        <h5>Total Paid in GIFT CERTIFICATE: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_members AS TM ON TS.customer_no = TM.member_no WHERE TM.barcode = $barcode AND TP.paymentType = 'Gift Cert.' " );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
                </div>

               
                      <div class="col-md-12" style="border:1px solid">
                        <div class="row">
                          <!-- TRANSACTION HISTORY-->
                          <div class="col-md-6">

                            <p>Transaction History</p>
                            <table id="" class="table table-bordered ">
                              <thead>
                                <tr>
                                  <th>SI No.</th>
                                  <th>Amount</th>
                                  <th>Payment Type</th>
                                  <th>Date</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              // $barcode = 5;
$sqlResult2 = $db->select(
                'TS.SI_no, TS.grand_total, TS.customer_no, TP.paymentType, TP.amount, TS.timestamp', 
                "tbl_sales AS TS" , 
                "LEFT JOIN tbl_payment AS TP ON TS.SI_no = TP.SI_no WHERE customer_type = 'm' AND TS.customer_no = " .  $memberID . " AND timestamp >= now()-interval 3 month ORDER BY TS.SI_no DESC");
                                  while ($dataAttri = $sqlResult2->fetch_assoc()) {
                                    ?>
                                    <tr>
                                      <td><?php echo $dataAttri['SI_no'] ?></td>
                                      <td align="right"><?php echo number_format($dataAttri['amount'], 2, ".", ",");?></td>
                                      <td><?php echo $dataAttri['paymentType'];?></td>
                                      <td><?php echo date('Y-m-d ', strtotime($dataAttri['timestamp'])); ?></td>
                                    </tr>
                                    <?php
                                  }
                              ?>
                              </tbody>
                            </table> 
                          </div>
                          <!-- PAYMENT HISTORY -->
                          <div class="col-md-6" style="">
                              <p>Payment History</p>
                              <table id="" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Amount</th>
                                    <th>Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $sqlResult3 = $db->select('paid, payDate', "tbl_creditpayment" , "WHERE customer_type = 'm' AND customer_no = " . $memberID . " ORDER BY payDate DESC");

                                    while ($dataAttri = $sqlResult3->fetch_assoc()) {
                                      ?>
                                      <tr>
                                        <td align="right"><?php echo number_format($dataAttri['paid'], 2, ".", ",");?></td>
                                        <td align="right"><?php echo $dataAttri['payDate']; ?></td>
                                      </tr>
                                      <?php
                                    }
                                ?>
                                </tbody>
                              </table>  
                          </div>
                        </div>
                      </div>

                  
                </div><!-- /.box-body -->
              </form>
            </div><!-- /.box -->
        <?php 
          }
        ?>

      </div><!-- /.col-md-12 --> 
  </div><!-- row-->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

    <div >
      <img src="images/f1-logo.png" alt="F1 Logo" class="img-responsive" width="200">
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
   
  </body>
</html>
