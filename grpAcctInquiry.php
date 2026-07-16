<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">


        <div class="box">
          <form action="grpAcctInquiry.php" method="get">
            
              <div class="box-header with-border">
                <h3 class="box-title"> Group's Account</h3>
                <div class="box-tools pull-right">
                </div>
              </div>

              <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">


                      <div class="form-group">
                        Display Account of:
                          <select required class="form-control" name="acctOf">
                            <option value="">Select Group</option>
                            <?php
                            $sqlResult = $db->select('group_no, group_name', 'tbl_groupcredit', 'ORDER BY group_name ASC');
                            while ($dataAttri = $sqlResult->fetch_assoc()) {
                              echo "<option " . (Input::get("acctOf") == $dataAttri['group_no'] ? "selected='selected'" : "") . "value=" . $dataAttri['group_no'] . ">". $dataAttri['group_name'] . "</option>";
                            }
                            ?>
                          </select>
                      </div>

                      <div class="form-group ">
                          <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" name="View" value="View">View</button>
                          </span>
                      </div><!-- /.form-group -->  
                  </div>
                </div><!--/.row-->
              </div><!-- /.box-body -->

              <div class="box-footer">
       
              </div><!-- /.box-footer-->

          </form>
        </div><!-- /.box -->

<?php if (Input::get('acctOf') !== '') { 
  $group_no = Input::get('acctOf');

  $sqlResult = $db->select_one("*", "tbl_groupcredit", "WHERE group_no = " . $group_no );
  if ($sqlResult) {
    $memberID = $sqlResult['group_no'];
    $memberNm = $sqlResult['group_name'];
      // $_SESSION['login_member_role'] = $sqlResult['role'];
?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Account of <?php echo $memberID . "-" . $memberNm;?></h3>
            <div class="box-tools pull-right">
            <!--  <h4><a href="download.php?what=inventoryReport">Export to CSV</a></h4>  -->
            </div>
          </div><!-- /.box-header -->
          <div class="box-body" style="">
            <!--background:url('core/logo50.gif') no-repeat center-->
                <div class="col-md-6">
                      <div class="form-group ">
                        <label>Group Name: <span style="color:#FF5722; font-size:18px"><?php echo ucfirst($sqlResult['group_name']); ?></span></label>
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
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_groupcredit AS TM ON TS.customer_no = TM.group_no WHERE TM.group_no = $memberID AND TP.paymentType = 'Cash' AND TS.cancelled = 0 " );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
                        <h5>Total CHARGED: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_groupcredit AS TM ON TS.customer_no = TM.group_no WHERE TM.group_no = $memberID AND TP.paymentType = 'Charge' AND TS.cancelled = 0 " );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
                        <h5>Total Paid in CHECK: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_groupcredit AS TM ON TS.customer_no = TM.group_no WHERE TM.group_no = $memberID AND TP.paymentType = 'Check' AND TS.cancelled = 0 " );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
                        <h5>Total Paid in GIFT CERTIFICATE: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_groupcredit AS TM ON TS.customer_no = TM.group_no WHERE TM.group_no = $memberID AND TP.paymentType = 'Gift Cert.' AND TS.cancelled = 0" );
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
                          // $group_no = 5;
          $sqlResult2 = $db->select(
            'TS.SI_no, TS.grand_total, TS.customer_no, TP.paymentType, TP.amount, TS.timestamp', 
            "tbl_sales AS TS" , 
            "LEFT JOIN tbl_payment AS TP ON TS.SI_no = TP.SI_no WHERE customer_type = 'm' AND TS.customer_no = " .  $memberID . " AND timestamp >= now()-interval 3 month AND TS.cancelled = 0 ORDER BY TS.SI_no DESC");
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
         </div><!-- /.box -->  

  <?php
    }
  } 
  ?>

      </div><!--/.col-md-12  -->

    </div><!-- /.row-->
  </section><!-- /.content -->

</div><!-- /.content-wrapper -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
