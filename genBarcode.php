<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/barcode.php';
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
          <form  action="genBarcodePrint.php" method="POST" target="_blank">
              <div class="box-header with-border">
                <h3 class="box-title">Generate Barcode</h3>
                <div class="box-tools pull-right">
                  <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <!-- ./title -->

              <div class="box-body">
                <div class="row">
                  <!-- ROW 1 STARTS HERE -->
                  <div class="col-md-6">

                    <div class="form-group ">
                        <label>Barcode Name</label>
                        <input required value=""  type="text" class="form-control" name="barcode_name" id="" placeholder="">
                    </div>

                  </div>

                  <!-- ROW 2 ENDS HERE -->
                </div>
              </div><!-- /.box-body -->

              <div class="box-footer">
                <!-- <p class="pull-left text-red"><b>All fields are required</b></p> -->
                <div class="form-group ">
                  <div class="col-lg-5 input-group">
                    <span class="input-group-btn">
                    <!-- <a href="print.html" class="btn btn-info" onclick="window.open('genBarcodePrint.php', 'newwindow', 'width=300, height=250'); return false;"> Generate</a> -->
                      <button class="btn btn-info" name="submit" type="submit" value="Save">Generate</button>
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

 <!-- =============================================== -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
