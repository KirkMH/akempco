<?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_useracct';
  $filter = 'user_no';
  $user_no = 0;

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
          <form action="/akempco/includes/processor.php?action=update" method="GET">
            
            <div class="box-header with-border">
              <h3 class="box-title">Update your Account</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- ./title -->

            <div class="box-body">
              <div class="row">
                <!-- ROW 1 STARTS HERE -->
                <div class="col-md-6">
                  <input name="action" value="update"  type="hidden">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="dataID" value="<?php echo $_SESSION['login_member_no']; ?>"  type="hidden">
                  <input name="filter" value="user_no"  type="hidden">
                  <input name="table" value="<?php echo $table; ?>" type="hidden">
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

                  <?php 
                    $sqlRes = $db->select_one("*", $table, "WHERE user_no=" . $_SESSION['login_member_no']);
                  ?>

                  <div class="form-group ">
                    <label>Full Name </label>
                    <label style="color:#00ACD6; padding-left:10px; font-size:20px"><?php echo ucfirst($sqlRes['fullname']); ?></label>
                  </div>

                  <div class="form-group ">
                    <label>Username </label>
                    <label style="color:#00ACD6; padding-left:10px; font-size:20px"><?php echo ucfirst($sqlRes['username']); ?></label>
                  </div>

                  <div class="form-group">
                    <label>New Password</label>
                    <input value="" type="text" class="form-control" name="password" id="" placeholder="">
                  </div>
                </div>
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
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
