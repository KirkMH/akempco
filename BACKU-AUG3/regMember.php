<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_members';
  $filter = 'member_no';
  $dept_no = Input::get('dept_no');

  if (isset($_POST['submitCSV'])) {
    if (is_uploaded_file($_FILES['csv']['tmp_name'])) {
      echo "<h1>" . "File ". $_FILES['csv']['name'] ." uploaded successfully." . "</h1>";
      echo "<h2>Displaying contents:</h2>";
      readfile($_FILES['csv']['tmp_name']);
    }

    //Import uploaded file to Database
    $handle = fopen($_FILES['csv']['tmp_name'], "r");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $db->insert($table, array_map('strtolower', $data) );
      
    }

    fclose($handle);

    print "Import done";

    //view upload form
  }
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
                  }
                  ?>

        <!-- Default box -->
        <div class="box">
          <form action="/akempco/includes/processor.php?<?php echo Input::get('member_no') ?  "action=update" : ""; ?>;" method="GET">
            
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Input::get('member_no') ?  "Update Member" : "Cooperative's Members Registration"; ?> </h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- ./title -->

            <div class="box-body">
              <div class="row">
                <!-- ROW 1 STARTS HERE -->
                <div class="col-md-6">
                  <input name="action" value="<?php echo Input::get('member_no') ?  'update' : 'insert'; ?>"  type="hidden">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="dataID" value="<?php echo Input::get('member_no') ?  $_GET['member_no'] : ''; ?>"  type="hidden">
                  <input name="filter" value="<?php echo Input::get('member_no') ?  'member_no' : ''; ?>"  type="hidden">
                  <input name="table" value="<?php echo $table; ?>" type="hidden">
                  <div class="form-group ">
                    <label>Barcode / Member's ID Number</label>
                    <input required value="<?php echo Input::get('barcode') ?  $_GET['barcode'] : ''; ?>"  type="text" class="form-control" name="barcode" id="" placeholder="">
                  </div>
                  <div class="form-group ">
                    <label>Members Name</label>
                    <input required  value="<?php echo Input::get('member_name') ?  $_GET['member_name'] : ''; ?>"  type="text" class="form-control" name="member_name" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Contact No.</label>
                    <input required  value="<?php echo Input::get('contact_no') ?  $_GET['contact_no'] : ''; ?>"  type="text" class="form-control" name="contact_no" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Address</label>
                    <input required  value="<?php echo Input::get('member_address') ?  $_GET['member_address'] : ''; ?>"  type="text" class="form-control" name="member_address" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Tax Identification Number</label>
                    <input required  value="<?php echo Input::get('member_tin') ?  $_GET['member_tin'] : ''; ?>"  type="text" class="form-control" name="member_tin" id="" placeholder="" data-mask="" data-inputmask="'mask': ['999-999-999-999']">
                  </div>


                </div>
                <div class="col-md-6">

                  <div class="form-group ">
                    <label>Department</label>
                      <select required class="form-control" name="dept_no">
                        <option value="">Select Department</option>
                        <?php
                          $sqlResult = $db->select('dept_no,dept_name', 'tbl_department', 'WHERE active=1');

                          while ($extractData = $sqlResult->fetch_assoc()) {
                            echo "<option value=".$extractData['dept_no'];
                            if ($extractData['dept_no'] == $dept_no) echo " selected='selected'";
                            echo ">".$extractData['dept_name']."</option>";
                          }
                        ?>

                      </select>      
                    <!-- <input value="<?php //echo isset($_GET['department']) ?  $_GET['department'] : ''; ?>"  type="text" class="form-control" name="department" id="" placeholder=""> -->
                  </div>
                  <div class="form-group ">
                    <label>Credit Limit</label>
                    <input required  id="credit_limit" value="<?php echo Input::get('credit_limit') ?  $_GET['credit_limit'] : ''; ?>"  type="text" class="form-control" name="credit_limit"  onchange="updateRemCredit();" placeholder="">
                  </div>
                  <?php if(!Input::get('action')) ?>
                    <input id="remaining_credit" name="remaining_credit" value="<?php echo Input::get('remaining_credit') ?>" type="hidden">
                  <?php 
                  ?>
                  <?php if(Input::get('action') == "update") ?>
                  <div class="form-group ">
                    <label>Extra Credit</label>
                    <input id="extra_credit" name="extra_credit" value="<?php echo Input::get('extra_credit') ?>" type="text"  class="form-control" onchange="updateRemCredit();">
                  </div>
                  <?php 
                  ?>

                  <div class="form-group">
                  <label>Member Type</label>
                    <select class="form-control" name="member_type">
                      <!-- <option >Select Status</option> -->
                      <option <?php echo Input::get('member_type') ?  ($_GET['member_type'] == 'Regular' ? 'selected="selected"' : '') : '';?> value="Regular" >Regular</option>
                      <option <?php echo Input::get('member_type') ?  ($_GET['member_type'] == 'Associate' ? 'selected="selected"' : '') : '';?> value="Associate" >Associate</option>
                    </select>
                  </div>    

                  <div class="form-group">
                  <label>Status</label>
                    <select class="form-control" name="active">
                      <!-- <option >Select Status</option> -->
                      <option <?php echo Input::get('active') ?  ($_GET['active'] == '1' ? 'selected="selected"' : '') : '';?> value="1" >Active</option>
                      <option <?php echo Input::get('active') ?  ($_GET['active'] == '0' ? 'selected="selected"' : '') : '';?> value="0" >Inactive</option>
                    </select>
                  </div>    

                </div>
                <!-- /.col-md-6-->
                <!-- ROW 2 ENDS HERE -->
              </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
              <p class="pull-left text-red"><b>All fields are required</b></p>
              <div class="form-group pull-right">
                <div class="col-lg-5 input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-info" name="submit" type="submit" value="Save">Save</button>
                  </span>
                </div><!-- /input-group -->
              </div><!-- /.form-group -->                 
            </div><!-- /.box-footer-->

          </form>
        </div><!-- /.box -->

        <!-- UPLOAD CSV FILE -->
        <!--
        <div class="box">
          <form action="regMember.php" method="post" enctype="multipart/form-data">
            <div class="box-header">
              <h3>Upload CSV file</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
            
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">Select Action</label> 
                  <select class="form-control">
                    <option selected="selected">Select Action</option>
                    <option>Add Bulk Members</option>
                    <option>Update Payment Records</option>
                  </select>
                </div>  

                <div class="form-group">
                  <input type="file" name="csv" value="" />
                </div>
              </div>
            </div>

            <div class="box-footer">
              <div class="form-group pull-right">
                <div class="col-lg-5 input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-info" type="submit" name="submitCSV" >Upload</button>
                  </span>
                </div>
              </div>
            </div>
          </form>
        </div>

             -->

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Registered Cooperative's Members</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group"><input type="button" onclick="location.href='inactiveMembers.php'" value="View Inactive Members" /></div>
            <table id="tbl_members" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTIONS</th>
                  <th>Members Name</th>
                  <th>Member Type</th>
                  <th>Contact No.</th>
                  <th>Address</th>
                  <th>TIN</th>
                  <th>Department</th>
                  <th>Credit Limit</th>
                  <th>Extra Credit</th>
                  <th>Total Charged</th>
                </tr>
              </thead>
              <tbody>                      
                <?php 
                // $sqlResult = $db->select('*', $table, 'ORDER BY active DESC');
              $sqlResult = $db->select('tm.member_no, tm.member_name, tm.contact_no, tm.member_address, tm.member_tin, tc.dept_name, tm.credit_limit, tm.charge_total, tm.extra_credit, tm.member_type', $table . " AS tm ", 'INNER JOIN tbl_department AS tc ON tm.dept_no = tc.dept_no WHERE tm.active = 1 ORDER BY tm.active DESC');
              if($sqlResult){
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['member_no'];
                  ?>
                  <tr>
                    <td> 
                      <a href="/akempco/includes/processor.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID?> ">UPDATE</a> |
                      <a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID ?>&active=" onclick="return (confirm('Are you sure you want to delist this member?'));">DELIST</a>
                      </td>
                     <td><?php echo $dataAttri['member_name'];?></td>
                     <td><?php echo $dataAttri['member_type'];?></td>
                     <td><?php echo $dataAttri['contact_no'];?></td>
                     <td><?php echo $dataAttri['member_address'];?></td>
                     <td><?php echo $dataAttri['member_tin'];?></td>
                     <td><?php echo $dataAttri['dept_name'];?></td>
                     <td align="right"><?php echo number_format($dataAttri['credit_limit'], 2, ".", ",");?></td>
                     <td align="right"><?php echo number_format($dataAttri['extra_credit'], 2, ".", ",");?></td>
                     <td align="right"><?php echo number_format($dataAttri['charge_total'], 2, ".", ",");?></td>
                   </tr>
                   <?php
                 }
               }
                 ?>
               </tbody>
             </table>
           </div><!-- /.box-body -->
         </div><!-- /.box --> 
       </div>
     </div>
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->

 <script type="text" language="javascript">
 function updateRemCredit() {
  var l = document.getElementById("credit_limit").value;
  var x = document.getElementById("extra_credit").value;
  var r = document.getElementById("remaining_credit").value;
  var newR = 
 }
 </script>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
