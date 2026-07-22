<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';

// Enforce ADMINISTRATOR role security check
if ($_SESSION['login_member_role'] !== 'ADMINISTRATOR') {
  Redirect::to('/akempco/index.php');
}

$audit = new Audit();
// Process Form Submission for Saving Adjustment
if (isset($_POST['save_adjustment'])) {
  if (Token::check(Input::get('token'))) {
    $cp_no = intval(Input::get('cp_no'));
    $new_paid = floatval(Input::get('paid'));
    $new_payDate = date("Y-m-d", strtotime(Input::get('payDate')));
    $new_ref_no = Input::get('ref_no');

    $original = $db->select_one("*", "tbl_creditpayment", "WHERE cp_no = $cp_no");
    if ($original) {
      $data_update = array(
        'paid' => $new_paid,
        'payDate' => $new_payDate,
        'ref_no' => $new_ref_no
      );

      if ($db->update('tbl_creditpayment', $data_update, "WHERE cp_no = $cp_no")) {
        $data_update_string = implode(",", $data_update);
        $audit->record($_SESSION['login_member_no'], "update", "tbl_creditpayment", "cp_no=$cp_no, " . $data_update_string, date('Y-m-d'), date('H:i:s'));
        
        Session::flash('msg', "Payment record successfully adjusted!");
        Redirect::to("creditPaymentAdjustment.php?customer_type=" . $original['customer_type'] . "&customer_no=" . $original['customer_no']);
      } else {
        Session::flash('err', "Opps. Sorry, there was an error updating the database.");
      }
    } else {
      Session::flash('err', "Payment record not found.");
    }
  }
}

// Process Deletion of Credit Payment
$delete_cp_no = Input::get('delete_cp_no');
if (!empty($delete_cp_no)) {
  $cp_no = intval($delete_cp_no);
  $original = $db->select_one("*", "tbl_creditpayment", "WHERE cp_no = $cp_no");
  if ($original) {
    if ($db->delete('tbl_creditpayment', "WHERE cp_no = $cp_no")) {
      $audit->record($_SESSION['login_member_no'], "delete", "tbl_creditpayment", "cp_no=$cp_no", date('Y-m-d'), date('H:i:s'));
      Session::flash('msg', "Payment record successfully deleted!");
      Redirect::to("creditPaymentAdjustment.php?customer_type=" . $original['customer_type'] . "&customer_no=" . $original['customer_no']);
    } else {
      Session::flash('err', "Opps. Sorry, there was an error deleting the payment record.");
    }
  } else {
    Session::flash('err', "Payment record not found.");
  }
}

$token = Token::generate();

$edit_cp_no = Input::get('edit_cp_no');
$payment = null;
$customer_name = "";
$customer_type_label = "";

if (!empty($edit_cp_no)) {
  $payment = $db->select_one("*", "tbl_creditpayment", "WHERE cp_no = " . intval($edit_cp_no));
  if ($payment) {
    if ($payment['customer_type'] == 'm') {
      $customer = $db->select_one("member_name", "tbl_members", "WHERE member_no = " . intval($payment['customer_no']));
      $customer_name = $customer ? $customer['member_name'] : 'Unknown Member';
      $customer_type_label = 'Member';
    } else {
      $customer = $db->select_one("group_name", "tbl_groupcredit", "WHERE group_no = " . intval($payment['customer_no']));
      $customer_name = $customer ? $customer['group_name'] : 'Unknown Group';
      $customer_type_label = 'Group Credit';
    }
  }
}

$customer_type = Input::get('customer_type');
$customer_no = Input::get('customer_no');

require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 

        <?php if(Session::exists('msg')){ ?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-check"></i> <?php echo Session::flash('msg'); ?></h4>
          </div>
        <?php } else if(Session::exists('err')){ ?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-ban"></i> <?php echo Session::flash('err'); ?></h4>
          </div>
        <?php } ?>

        <?php if ($payment): ?>
          <!-- ADJUSTMENT FORM VIEW -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Adjust Payment Record</h3>
            </div>
            <form action="creditPaymentAdjustment.php" method="post">
              <input type="hidden" name="token" value="<?php echo $token; ?>" />
              <input type="hidden" name="cp_no" value="<?php echo $payment['cp_no']; ?>" />
              
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Creditor Type</label>
                      <input type="text" class="form-control" value="<?php echo $customer_type_label; ?>" disabled />
                    </div>

                    <div class="form-group">
                      <label>Creditor Name</label>
                      <input type="text" class="form-control" value="<?php echo $customer_name; ?>" disabled />
                    </div>

                    <div class="form-group">
                      <label>Amount Paid</label>
                      <input required type="number" step="0.01" min="0" class="form-control" name="paid" id="paid" value="<?php echo htmlspecialchars($payment['paid']); ?>">
                    </div>

                    <div class="form-group">
                      <label>Date Paid</label>
                      <input required type="date" class="form-control" name="payDate" id="payDate" value="<?php echo htmlspecialchars($payment['payDate']); ?>">
                    </div>

                    <div class="form-group">
                      <label>Reference</label>
                      <input required type="text" class="form-control" name="ref_no" id="ref_no" value="<?php echo htmlspecialchars($payment['ref_no']); ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="form-group pull-right">
                  <button class="btn btn-info" type="submit" name="save_adjustment" value="save">Save Changes</button>
                  <a href="creditPaymentAdjustment.php?customer_type=<?php echo $payment['customer_type']; ?>&customer_no=<?php echo $payment['customer_no']; ?>" class="btn btn-default">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        <?php else: ?>
          <!-- SELECTION & LIST VIEW -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Credit Payment Adjustment</h3>
            </div>
            <form action="creditPaymentAdjustment.php" method="get">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Payment from</label>
                      <select required class="form-control" name="customer_type" id="customer_type" onchange="reloadWith();">
                        <option value="">Select</option>
                        <option <?php echo $customer_type == 'm' ? 'selected="selected"' : ''; ?> value="m">Member</option>
                        <option <?php echo $customer_type == 'g' ? 'selected="selected"' : ''; ?> value="g">Group Credit</option>
                      </select>
                    </div>

                    <?php if ($customer_type == 'g'): ?>
                      <div class="form-group">
                        <label>Group Credit's Name</label>
                        <select required class="form-control" name="customer_no">
                          <option value="">Select Group</option>
                          <?php
                            $sqlResult = $db->select('group_no, group_name', 'tbl_groupcredit', 'WHERE active=1 ORDER BY group_name');
                            while ($extractData = $sqlResult->fetch_assoc()) {
                              echo "<option " . ($customer_no == $extractData['group_no'] ? "selected='selected'" : "") . " value=".$extractData['group_no'].">".$extractData['group_name']."</option>";
                            }
                          ?>
                        </select>
                      </div>
                    <?php elseif ($customer_type == 'm'): ?>
                      <div class="form-group">
                        <label>Member's Name</label>
                        <select required class="form-control" name="customer_no">
                          <option value="">Select Member</option>
                          <?php
                            $sqlResult = $db->select('member_no, member_name', 'tbl_members', 'WHERE active=1 ORDER BY member_name');
                            while ($extractData = $sqlResult->fetch_assoc()) {
                              echo "<option " . ($customer_no == $extractData['member_no'] ? "selected='selected'" : "") . " value=".$extractData['member_no'].">".$extractData['member_name']."</option>";
                            }
                          ?>
                        </select>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <?php if (!empty($customer_type)): ?>
                  <div class="form-group pull-right">
                    <button class="btn btn-info" type="submit">View Payments</button>
                  </div>
                <?php endif; ?>
              </div>
            </form>
          </div>

          <?php if (!empty($customer_type) && !empty($customer_no)): ?>
            <!-- PAYMENT HISTORY TABLE -->
            <div class="box">
              <div class="box-header">
                <?php
                  $selected_customer_name = "";
                  if ($customer_type == 'm') {
                    $c_res = $db->select_one("member_name", "tbl_members", "WHERE member_no = " . intval($customer_no));
                    $selected_customer_name = $c_res ? $c_res['member_name'] : '';
                  } else {
                    $c_res = $db->select_one("group_name", "tbl_groupcredit", "WHERE group_no = " . intval($customer_no));
                    $selected_customer_name = $c_res ? $c_res['group_name'] : '';
                  }
                ?>
                <h3 class="box-title">Payment History for <?php echo htmlspecialchars($selected_customer_name); ?></h3>
              </div>
              <div class="box-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 100px;">Actions</th>
                      <th>Amount Paid</th>
                      <th>Date Paid</th>
                      <th>Reference No.</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $payments_list = $db->select('*', 'tbl_creditpayment', "WHERE customer_type = '" . $db->escape($customer_type) . "' AND customer_no = " . intval($customer_no) . " ORDER BY payDate DESC");
                      if ($payments_list && $payments_list->num_rows > 0) {
                        while ($row = $payments_list->fetch_assoc()) {
                          ?>
                          <?php
                            $amt_str = "P " . number_format($row['paid'], 2, ".", ",");
                            $ref_str = htmlspecialchars($row['ref_no'], ENT_QUOTES);
                          ?>
                          <tr>
                            <td>
                              <a href="creditPaymentAdjustment.php?edit_cp_no=<?php echo $row['cp_no']; ?>" class="btn btn-warning btn-xs">Edit</a>&nbsp;
                              <a href="creditPaymentAdjustment.php?delete_cp_no=<?php echo $row['cp_no']; ?>" class="btn btn-danger btn-xs" onclick="return confirmDelete(event, this.href, '<?php echo $amt_str; ?>', '<?php echo $ref_str; ?>');">Delete</a>
                            </td>
                            <td align="right">P <?php echo number_format($row['paid'], 2, ".", ","); ?></td>
                            <td><?php echo date("Y-m-d", strtotime($row['payDate'])); ?></td>
                            <td><?php echo htmlspecialchars($row['ref_no']); ?></td>
                          </tr>
                          <?php
                        }
                      } else {
                        ?>
                        <tr>
                          <td colspan="4" align="center">No payment history found.</td>
                        </tr>
                        <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php endif; ?>
        <?php endif; ?>

      </div>
    </div>
  </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script language="javascript">
function confirmDelete(event, url, amount, refNo) {
  event.preventDefault();
  var message = "Do you really want to delete this payment record?";
  if (amount && refNo) {
    message = "Do you really want to delete payment of " + amount + " (Ref No: " + refNo + ")?";
  } else if (amount) {
    message = "Do you really want to delete payment of " + amount + "?";
  }

  if (typeof Swal !== 'undefined') {
    Swal.fire({
      title: 'Are you sure?',
      text: message,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  } else {
    if (confirm(message)) {
      window.location.href = url;
    }
  }
  return false;
}

function reloadWith() {
  var val = document.getElementById('customer_type').value;
  if (val == "") {
    alert("Please select customer type first.");
  } else {
    window.location.href = "creditPaymentAdjustment.php?customer_type=" + val;
  }
}
</script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
