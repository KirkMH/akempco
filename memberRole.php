<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_useracct';
  $filter = 'user_no';
  $dept_no = 0;
  $token = Token::generate();
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 

     

        <!-- Default box -->
        <div class="box">
          <form action="/akempco/includes/processor.php?<?php echo Input::get('user_no') ?  "action=update" : ""; ?>;" method="GET">
            <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Input::get('user_no') ?  "Update Member" : "Cooperative's Members Registration"; ?> </h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- ./title -->

            <div class="box-body">
              <div class="row">
                <!-- ROW 1 STARTS HERE -->
                <div class="col-md-6">
                  <input name="action" value="<?php echo Input::get('user_no') ?  'update' : 'insert'; ?>"  type="hidden">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="dataID" value="<?php echo Input::get('user_no') ?  $_GET['user_no'] : ''; ?>"  type="hidden">
                  <input name="filter" value="<?php echo Input::get('user_no') ?  'user_no' : ''; ?>"  type="hidden">
                  <input name="table" value="<?php echo $table; ?>" type="hidden">
                  
                  <div class="form-group ">
                    <label>Full Name</label>
                    <input required  value="<?php echo Input::get('fullname') ?  $_GET['fullname'] : ''; ?>"  type="text" class="form-control" name="fullname" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Username</label>
                    <input required=""  value="<?php echo Input::get('username') ?  $_GET['username'] : ''; ?>"  type="text" class="form-control" name="username" id="" placeholder="">
                  </div>

                  <?php
                    if(Input::get('user_no') == "") {
                  ?>
                      <div class="form-group">
                        <label>Temporary Password</label>
                        <input value="<?php echo randomPassword(); ?>" type="text" class="form-control" name="password" id="" placeholder="">
                      </div>
                  <?php 
                    } else {
                  ?>
                      <div class="form-group">
                        <label>Password</label>
                        <input value="<?php echo Input::get('password'); ?>" type="text" class="form-control" name="password" id="" placeholder="">
                      </div>
                  <?php 
                    } 
                  ?>
                </div>

                <div class="col-md-6">

                  <div class="form-group ">
                    <label>Role</label>
                      <select required class="form-control" name="role_id">
                        <option value="">Select Department</option>
                        <?php
                          $sqlResult = $db->select('role_id,role_name', 'roles');

                          while ($extractData = $sqlResult->fetch_assoc()) {
                            echo "<option value='".$extractData['role_id'] . "'";
                            echo Input::get('role_id') ? Input::get('role_id') == $extractData['role_id'] ? "selected" : "" : "" ;
                            echo ">" . $extractData['role_name']."</option>";
                          }
                        ?>
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="">Status</label>
                    <select required class="form-control" name="active">
                      <option value="">Select Status</option>
                      <option <?php echo Input::get('active') ?  (Input::get('active') == '1' ? 'selected="selected"' : '') : '';?> value="1" >Active</option>
                      <option <?php echo Input::get('active') ?  (Input::get('active') == '0' ? 'selected="selected"' : '') : '';?> value="0" >Inactive</option>
                    </select>
                  </div>

                  <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input <?php echo (Input::get('override')) ? "checked" : "0" ;?> type="checkbox" name="override"> Permission to overide
                        </label>
                      </div>
                  </div>
                </div>
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
       </div>
     </div>
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
