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

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Delisted Cooperative's Members</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group"><input type="button" onclick="location.href='regMember.php'" value="View Active Members" /></div>
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
              $sqlResult = $db->select('tm.member_no, tm.member_name, tm.contact_no, tm.member_address, tm.member_tin, tc.dept_name, tm.credit_limit, tm.charge_total, tm.extra_credit, tm.member_type', $table . " AS tm ", 'INNER JOIN tbl_department AS tc ON tm.dept_no = tc.dept_no WHERE tm.active=0 ORDER BY tm.member_name ASC');
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['member_no'];
                  ?>
                  <tr>
                    <td> 
                      <a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID ?>&active=1"  onclick="return (confirm('Are you sure you want to restore this member?'));">RESTORE</a>
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
