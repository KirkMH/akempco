<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';


if(Input::get('save')){
  $data1 = array(
    'setting_value' => Input::get('vat')
    );
  if ($db->update('tbl_settings', $data1 , "WHERE setting_name = 'VATable'") ) {
    // echo "<script>alert('Record saved!')</script>";
  }

  $data2 = array(
    'setting_value' => (Input::get('checks') == "on" ? "1" : "0")
    );  
  if ($db->update('tbl_settings', $data2 , "WHERE setting_name = 'Check'") ) {
    // echo "<script>alert('Record saved!')</script>";
  }
}
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
          <form action="" method="POST">

            <div class="box-header with-border">
              <h3 class="box-title"> Update Settings</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
              <div class="row">          
                <div class="col-md-6">

                  <div class="form-group ">
                    <label>VAT Percentage</label>
                    <?php $sqlResVat = $db->select_one('setting_value', 'tbl_settings', "WHERE setting_name='VATable'"); ?>
                    <input type="text" class="form-control" name="vat" placeholder="" value="<?php echo $sqlResVat['setting_value']; ?>"  >
                  </div>

                  <div class="form-group">
                      <div class="checkbox">
                        <label>
                        <?php $sqlResCheck = $db->select_one('setting_value', 'tbl_settings', "WHERE setting_name='Check'"); ?>
                          <input <?php echo ($sqlResCheck['setting_value'] == "1") ? "checked" : "" ;?> type="checkbox" name="checks"> Accept Check
                        </label>
                      </div>
                  </div>

                </div>

              </div><!--/.row-->
            </div><!-- /.box-body -->

            <div class="box-footer">
              <p class="pull-left text-red"><b>* Required fields</b></p>
              <div class="form-group pull-right">
                <div class="col-lg-5 input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-info" type="submit" name="save" value="save">Save</button>
                  </span>
                </div><!-- /input-group -->
              </div><!-- /.form-group -->                 
            </div><!-- /.box-footer-->

          </form>
        </div><!-- /.box -->


      </div>  
    </div><!-- row-->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->



<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>