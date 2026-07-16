
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

$table = 'tbl_groupcredit';
$table2 = 'tbl_groupmembers';
$filter = 'group_no';
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
          <form action="/akempco/includes/processor.php?<?php echo isset($_GET['group_no']) ?  "action=update" : ""; ?>;">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo isset($_GET['group_no']) ?  "Update Group" : "Group Credit Registration"; ?> </h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- ./title -->

            <div class="box-body">
              <div class="row">
                <!-- ROW 1 STARTS HERE -->
                <div class="col-md-6">
                  <input name="action" value="<?php echo isset($_GET['group_no']) ?  'update' : 'insert'; ?>"  type="hidden">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="dataID" value="<?php echo isset($_GET['group_no']) ?  $_GET['group_no'] : ''; ?>"  type="hidden">
                  <input name="filter" value="<?php echo isset($_GET['group_no']) ?  'group_no' : ''; ?>"  type="hidden">
                  <input name="table" value="<?php echo $table ?>" type="hidden">
                  <input name="department" value="" type="hidden">
                  <input name="charge_total" value="0" type="hidden">
                  <div class="form-group ">
                    <label>Group Name</label>
                    <input required value="<?php echo isset($_GET['group_name']) ?  $_GET['group_name'] : ''; ?>"  type="text" class="form-control" name="group_name" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Head Name</label>
                    <input required value="<?php echo isset($_GET['headName']) ?  $_GET['headName'] : ''; ?>"  type="text" class="form-control" name="headName" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Contact No</label>
                    <input required value="<?php echo !isset($_GET['gm_no']) ? isset($_GET['contact_no']) ? $_GET['contact_no'] : "" : ''; ?>"  type="text" class="form-control" name="contact_no" id="" placeholder="">
                  </div>

                </div>
                <!-- /.col-md-6-->
                <div class="col-md-6">

                  <div class="form-group ">
                    <label>No of Members</label>
                    <input required value="<?php echo isset($_GET['num_members']) ?  $_GET['num_members'] : ''; ?>"  type="text" class="form-control" name="num_members" id="" placeholder="">
                  </div> 

                  <div class="form-group ">
                    <label>Credit Limit</label>
                    <input required value="<?php echo isset($_GET['credit_limit']) ?  $_GET['credit_limit'] : ''; ?>"  type="text" class="form-control" name="credit_limit" id="" placeholder="">
                  </div>

                  <div class="form-group">
                  <label>Status</label>
                    <select required class="form-control" name="active">
                      <option value="">Select Status</option>
                      <option <?php echo isset($_GET['active']) ?  ($_GET['active'] == '1' ? 'selected="selected"' : '') : '';?> value="1" >Active</option>
                      <option <?php echo isset($_GET['active']) ?  ($_GET['active'] == '0' ? 'selected="selected"' : '') : '';?> value="" >Inactive</option>
                    </select>
                  </div>                                 
                </div>
                <!-- ROW 1 ENDS HERE -->
              </div>

            </div><!-- /.box-body -->


            <div class="box-footer">
              <p class="pull-left text-red"><b>All fields are required</b></p>
              <div class="form-group pull-right">
                <div class="col-lg-5 input-group">
                  <span class="input-group-btn">
                    <button class=" btn btn-info" name="submit" type="submit" value="Save">Save</button>
                  </span>
                </div>
              </div>
            </div>

          </form>
        </div>
<!--
        <div class="box">
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

              <div class="input-group">
                <input type="file">
              </div>
            </div>
          </div>

          <div class="box-footer">
            <div class="form-group pull-right">
              <div class="col-lg-5 input-group">
                <span class="input-group-btn">
                  <button class="btn btn-info" type="button">Save</button>
                </span>
              </div>
            </div>
          </div>
        </div>
 -->

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Registered Group Credit</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group"><input type="button" onclick="location.href='inactiveGroupCredit.php'" value="View Delisted Group Credits" /></div>
            <table id="tbl_groupcredit" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTIONS</th>
                  <th>Group Name</th>
                  <th>Head Name</th>
                  <th>Contact No.</th>
                  <th>No. of Members</th>
                  <th>Credit Limit</th>
                  <th>Total Charged</th>
                </tr>
              </thead>
              <tbody>                      
                <?php 
                $sqlResult = $db->select('*', $table, 'WHERE active = 1 ORDER BY group_name');
                if($sqlResult){
                  while ($dataAttri = $sqlResult->fetch_assoc()) {
                    ?>
                    <tr>
                      <td> 
                        <a href="/akempco/includes/processor.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter?>&dataID=<?php echo $dataAttri['group_no']; ?> ">UPDATE GROUP INFO</a> <br>
                        <a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter?>&dataID=<?php echo $dataAttri['group_no']; ?>&active=" onclick="return (confirm('Are you sure you want to delist this group credit?'));">DELIST GROUP</a></td>
                        <td><?php echo $dataAttri['group_name'];?></td>
                        <td><?php echo $dataAttri['headName'];?></td>
                        <td><?php echo $dataAttri['contact_no'];?></td>
                        <td align="right"><?php echo $dataAttri['num_members'];?></td>
                        <td align="right"><?php echo number_format($dataAttri['credit_limit'], 2, ".", ",");?></td>
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

  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
  ?>
