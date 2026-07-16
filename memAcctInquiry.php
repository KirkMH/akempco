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
          <form action="memAcctInquiry.php" method="get">
            
              <div class="box-header with-border">
                <h3 class="box-title"> Member's Account</h3>
                <div class="box-tools pull-right">
                </div>
              </div>

              <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">


                      <div class="form-group">
                        Display Account of:
                          <select required class="form-control" name="acctOf">
                            <option value="">Select Member</option>
                            <?php
                            $sqlResult = $db->select('member_no, member_name', 'tbl_members', 'ORDER BY member_name ASC');
                            while ($dataAttri = $sqlResult->fetch_assoc()) {
                              echo "<option " . (Input::get("acctOf") == $dataAttri['member_no'] ? "selected='selected'" : "") . "value=" . $dataAttri['member_no'] . ">". $dataAttri['member_name'] . "</option>";
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
  $member_no = Input::get('acctOf');

  $sqlResult = $db->select_one("*", "view_member_credit_balances", "WHERE member_no = " . $member_no );
  if ($sqlResult) {
    $memberID = $sqlResult['member_no'];
    $memberNm = $sqlResult['member_name'];
	$memberPayable = $sqlResult['balance'];
	$memberRemaining = $sqlResult['credit_balance'];
	$memberCharged = $sqlResult['total_charge'];
	$memberPayments = $sqlResult['total_payment'];
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
				<div class="row">
					<div class="col-md-6">
						  <div class="form-group ">
							<label>Member Name: <span style="color:#FF5722; font-size:18px"><?php echo ucfirst($memberNm); ?></span></label>
						  </div>
					</div>
					<div class="col-md-6">
						  <div class="form-group ">
							<label>Payable: <span style="color:#FF5722; font-size:18px">P <?php echo number_format($memberPayable,2,'.', ','); ?></span></label><br />
							<label>Rem. Credit: <span style="color:#22B14C; font-size:18px">P <?php echo number_format($memberRemaining,2,'.', ','); ?></span></label>
						  </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
                        <h5>Total Paid in CASH: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_members AS TM ON TS.customer_no = TM.member_no WHERE TM.member_no = $memberID AND TP.paymentType = 'Cash' AND TS.cancelled = 0 " );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
                        <h5>Total CHARGED: P
                          <?php echo number_format($memberCharged,2,'.', ','); ?>
                        </h5>
                        <h5>Total Paid in CHECK: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_members AS TM ON TS.customer_no = TM.member_no WHERE TM.member_no = $memberID AND TP.paymentType = 'Check' AND TS.cancelled = 0 " );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
                        <h5>Total Paid in GIFT CERTIFICATE: P
                          <?php 
                            $sqlResult = $db->select_one("SUM(amount)", "tbl_payment AS TP", "INNER JOIN tbl_sales AS TS ON TP.SI_no = TS.SI_no INNER JOIN tbl_members AS TM ON TS.customer_no = TM.member_no WHERE TM.member_no = $memberID AND TP.paymentType = 'Gift Cert.' AND TS.cancelled = 0" );
                            if ($sqlResult) {
                              echo number_format($sqlResult['SUM(amount)'], 2, ".", ",");
                            }
                            else
                              echo "0.00";
                          ?>
                        </h5>
					</div>
					<div class="col-md-6">
						<h5>Total Charge Payments: P
                          <?php echo number_format($memberPayments,2,'.', ','); ?>
                        </h5>
					</div>
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
                          // $member_no = 5;
          $sqlResult2 = $db->select(
            'TS.SI_no, TS.grand_total, TS.customer_no, TP.paymentType, TP.amount, TS.timestamp', 
            "tbl_sales AS TS" , 
            "LEFT JOIN tbl_payment AS TP ON TS.SI_no = TP.SI_no WHERE customer_type = 'm' AND TS.customer_no = " .  $memberID . " AND TS.cancelled = 0 ORDER BY TS.SI_no DESC");
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
								<th>Reference No</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $sqlResult3 = $db->select('paid, payDate, ref_no', "tbl_creditpayment" , "WHERE customer_type = 'm' AND customer_no = " . $memberID . " ORDER BY payDate DESC");

                                while ($dataAttri = $sqlResult3->fetch_assoc()) {
                                  ?>
                                  <tr>
                                    <td align="right"><?php echo number_format($dataAttri['paid'], 2, ".", ",");?></td>
                                    <td align="right"><?php echo $dataAttri['payDate']; ?></td>
									<td align="right"><?php echo $dataAttri['ref_no']; ?></td>
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
