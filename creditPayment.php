<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
$audit = new Audit();
  $table = 'tbl_productprice';
  $filter = 'prod_no';
  $sup_no = 0;


if(Input::get('customer_type')){

  if(Token::check(Input::get('token'))){

    $data = array();
    $data[0] = Input::get('customer_no');
    $data[1] = "";
    $data[2] = "";
    $data[3] = Input::get('paid');
    $data[4] = Input::get('payDate');
    $data[5] = Input::get('ref_no');
    $type = Input::get('customer_type');


      // 1. tbl_creditpayment
      //$date = DateTime::createFromFormat('d/m/Y H:i', $data[4]);
      $data2 = array(
        'customer_type' => $type,
        'customer_no' => $data[0],
        'paid' => $data[3],
        'payDate' => date ("Y-m-d", strtotime($data[4])),
        'ref_no' => $data[5]
        );    

      if($db->insert('tbl_creditpayment', $data2) ){
        $msg = "Record saved!";
        $data2string = implode(",",$data2);
        // echo $_SESSION['login_member_no'] . "<br> " . "insert". "<br> " . "tbl_creditpayment". "<br> " . "<br> " . date('Y-m-d'). "<br> " . date('H:i:s') ;
        // print_r($data2);
        $audit->record($_SESSION['login_member_no'], "insert", "tbl_creditpayment", $data2string, date('Y-m-d'), date('H:i:s'));
      }else{
        $msg = "Opps. Sorry there was an error saving in the database.";
      }    

      // 2. update balances at tbl_members or tbl_groupcredit
      $tbl = "";
      $col = "";
      $cname = "";
      if ($type == "m") {
        $tbl = 'tbl_members';
        $col = 'member_no';
        $cname = "member_name";
      }
      else {
        $tbl = 'tbl_groupcredit';
        $col = 'group_no';
        $cname = "group_name";
      }

      $newTotal = 0;
      $dName = "";
      $ex1 = $db->select_one("charge_total, $cname AS dName", $tbl, "WHERE $col=$data[0]");
      
      if ($ex1 !== null) {
        $newTotal = $ex1['charge_total']-$data[3];
        $dName = $ex1['dName'];
      }
      $data2 = array(
        "charge_total" => $newTotal
        );
      
      if($db->update($tbl, $data2, "WHERE $col = $data[0]")){
        $msg = "Payment updated!";
        $data2string = implode(",",$data2);
        $audit->record($_SESSION['login_member_no'], "update", $tbl, $data2string, date('Y-m-d'), date('H:i:s'));
      }else{
        $msg = "Opps. Sorry there was an error saving in the database.";
      } 


      Session::flash('msg', "Payment for $dName was updated. From P ".number_format($ex1['charge_total'], 2, ".", ",").", the new balance is now P ".number_format($newTotal, 2, ".", ","));
  }
}

$token = Token::generate();
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

  // function saveCreditPayment($db, $data, $type) {
  // }

?> 
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 

        <?php 
          if(Session::exists('msg')){
        ?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4>  <i class="icon fa fa-check"></i> <?php  echo Session::flash('msg') ?></h4>
          </div>
        <?php 
        }else if(Session::exists('err')){
        ?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4>  <i class="icon fa fa-check"></i> <?php  echo Session::flash('err') ?></h4>
          </div>
        <?php 
        }
        ?>
        <!-- Default box -->
        <div class="box">
          <form action="creditPayment.php" method="post" >
            <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Input::get('customer_type') == "m" ?  "Add Member Payment" : "Add Group Credit Payment"; ?> </h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>
              <input type="hidden" name="customer_type" value="<?php echo (Input::get('customer_type') ? Input::get('customer_type') : '');?>" />
            <div class="box-body">
              <div class="row">
                <!-- ROW 1 STARTS HERE -->
                <div class="col-md-6">

                  <div class="form-group ">
                    <label>Payment from</label>
                    <select required class="form-control" name="customer_type" id="customer_type" onchange="reloadWith();">
                    <option value="">Select</option>
                      <option <?php echo Input::get('customer_type') ?  (Input::get('customer_type') == 'm' ? 'selected="selected"' : '') : '';?> value="m">Member</option>
                      <option <?php echo Input::get('customer_type') ?  (Input::get('customer_type') == 'g' ? 'selected="selected"' : '') : '';?> value="g">Group Credit</option>
                    </select>
                  </div>

                <?php if (Input::get('customer_type') == "g") { ?>
                  <div class="form-group ">
                    <label>Group Credit's Name</label>
                      <select required class="form-control" name="customer_no">
                        <option value="">Select Group</option>
                        <?php
                          $sqlResult = $db->select('group_no, group_name', 'tbl_groupcredit', 'WHERE active=1 ORDER BY group_name');

                          while ($extractData = $sqlResult->fetch_assoc()) {
                            echo "<option value=".$extractData['group_no'].">".$extractData['group_name']."</option>";
                          }
                        ?>

                      </select>      
                  </div>
                <?php } else { ?>
                  <div class="form-group ">
                    <label>Member's Name</label>
                      <select required class="form-control" name="customer_no">
                        <option value="">Select Member</option>
                        <?php
                          $sqlResult = $db->select('member_no,member_name', 'tbl_members', 'WHERE active=1 ORDER BY member_name');

                          while ($extractData = $sqlResult->fetch_assoc()) {
                            echo "<option value=".$extractData['member_no'].">".$extractData['member_name']."</option>";
                          }
                        ?>

                      </select>      
                  </div>
                <?php } ?>

                  <div class="form-group ">
                    <label>Amount Paid</label>
                    <input required  type="number" step="0.01" min="0" class="form-control" name="paid" id="paid" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Date Paid</label>
                    <input required  type="date" class="form-control datepicker" name="payDate" id="payDate" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Reference</label>
                    <input required  type="text" class="form-control" name="ref_no" id="ref_no" placeholder="" >
                  </div>


                </div>
                <!-- ROW 2 ENDS HERE -->
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer"> 
              <div class="form-group pull-right">
                <div class="col-lg-5 input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-info" type="submit" name="save" value="save" >Save</button>
                  </span>
               </div><!-- /input-group -->
              </div> <!-- /.form-group -->                 
            </div> <!-- /.box-footer-->

          </form>
        </div><!-- /.box -->            
          

        <!-- UPLOAD CSV FILE -->
        <div class="box">
          <!-- <form > -->
            <div class="box-header">
              <h3>Upload Payment</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>


            <div class="box-body">
              <div class="col-lg-10">
                <a href="download.php?what=g_payment">Click here to download the template for group credits' payment.</a><br/>
                <a href="download.php?what=m_payment">Click here to download the template for members' payment.</a>

              <?php //Upload File
                if (isset($_POST['submit'])) {
                  if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                      <h4><a name="TheNote">  <i class="icon fa fa-check"></i>File <?php  echo $_FILES['filename']['name'] ?> uploaded successfully.</a></h4>
                    </div>
                  <?php
                  }
                  //Import uploaded file to Database
                  $handle = fopen($_FILES['filename']['tmp_name'], "r");

                  $type = "";
                  $ctr = 0;
              ?>
                    <table id="tbl_supplier" class="sorttable table table-bordered table-striped">
                      <?php 
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                          if ($ctr == 0) {
                            $type = ($data[0] == "Member Payment" ? "m" : "g");
                      ?>
                            <thead>               
                              <tr>
                                <th colspan="6">
                                    <?php echo ($data[0] == "Member Payment" ? "<h4>Member Credits Payment</h4>" : "<h4>Group Credits Payment</h4>") ?>
                                </th>
                              </tr>
                      <?php
                          }
                          else if ($ctr == 1) { ?>
                              <tr>
                               <th><?php echo $data[0]; ?></th>
                               <th><?php echo $data[1]; ?></th>
                               <th><?php echo $data[2]; ?></th>
                               <th><?php echo $data[3]; ?></th>
                               <th><?php echo $data[4]; ?></th>
                               <th><?php echo $data[5]; ?></th>
                             </tr>
                            </thead>
                            <tbody>
                      <?php 
                          }else{
                      ?>
                              <tr>                 
                                <td align='right'><?php echo ucwords($data[0]);?></td>
                                <td><?php echo ucfirst($data[1]); ?></td>
                                <td><?php echo ucfirst($data[2]);?></td>
                                <td align='right'><?php echo ucfirst($data[3]); ?></td>
                                <td align='right'><?php echo ucfirst($data[4]);?></td>
                                <td><?php echo ucfirst($data[5]); ?></td>
                              </tr>
                      <?php
                            // 1. tbl_creditpayment
                            $date = DateTime::createFromFormat('d/m/Y H:i', $data[4]);
                            $data2 = array(
                              'customer_type' => $type,
                              'customer_no' => $data[0],
                              'paid' => $data[3],
                              'payDate' => date ("Y-m-d H:i:s", strtotime($data[4])),
                              'ref_no' => $data[5]
                              );

                            if($db->insert('tbl_creditpayment', $data2) ){
                              $msg = "Record saved!";
                            }else{
                              $msg = "Opps. Sorry there was an error saving in the database.";
                            }

                            // 2. update balances at tbl_members or tbl_groupcredit
                            $tbl = "";
                            $col = "";
                            if ($type == "m") {
                              $tbl = 'tbl_members';
                              $col = 'member_no';
                            }
                            else {
                              $tbl = 'tbl_groupcredit';
                              $col = 'group_no';
                            }

                            $newTotal = 0;
                            $ex1 = $db->select_one('charge_total', $tbl, "WHERE $col=$data[0]");
                            
                            if ($ex1 !== null) {
                              $newTotal = $ex1['charge_total']-$data[3];
                            }
                            $data2 = array(
                              "charge_total" => $newTotal
                              );

                            if($db->update($tbl, $data2, "WHERE $col = $data[0]")){
                              $msg = "Payment updated!";
                            }else{
                              $msg = "Opps. Sorry there was an error saving in the database.";
                            } 

                            // Session::flash('msg', $msg);

                            //$import="UPDATE tbl_product SET qty_onhand = (qty_onhand+$data[3]) WHERE prod_no = $data[0]";
                            //mysql_query($import) or die(mysql_error());  
                          }
                            $ctr = $ctr + 1;
                        }
                        ?>
                            </tbody>
                    </table>
              <?php
                  
                  fclose($handle);

                  print "\n\nImport completed.";

                  //view upload form
                }else {

                  print "<div>Upload CSV file by browsing the file and clicking on Upload.<br /><br /></div>";
              ?>
                  
                  <form enctype='multipart/form-data' action='creditPayment.php' method='post'>
                    <div class="form-group ">
                      <label>File to import</label>
                      <input required size='50' type='file' name='filename'>
                    </div>

                    <div class="form-group ">
                      <input type='submit' name='submit' value='Upload'>
                    </div>

                  </form>

              <?php 
                } 
              ?>


<!--                 <div class="input-group">
                  <input type="hidden" value="100000" name="MAX_FILE_SIZE">
                  <label for="">Upload CSV File</label>
                  <input type="file" name="file" id="file"> -->
                <!-- </div> --><!-- /input-group -->
              </div>
            </div><!-- /.box-body -->

            <!-- <div class="box-footer"> -->
              <!-- <div class="form-group pull-right"> -->
                <!-- <div class="col-lg-5 input-group"> -->
                  <!-- <span class="input-group-btn"> -->
                    <!-- <button class="btn btn-info" type="submit" name="submit" >Save</button> -->
                  <!-- </span> -->
                <!-- </div> --><!-- /input-group -->
              <!-- </div> --><!-- /.form-group -->                 
            <!-- </div> --><!-- /.box-footer-->
          <!-- </form> -->
        </div>


     </div>
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->

<script language="javascript">
function reloadWith() {
  var no;
  var no = document.getElementById('customer_type').value;
  if (no == "") {
    alert("Please select customer type first.");
  }
  else {
    window.location.href = "creditPayment.php?customer_type=".concat(no);
  }
}
</script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
