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
              <!-- Default box -->
              <div class="box">
                <form action="">
                  
                    <div class="box-header with-border">
                      <h3 class="box-title"> Features</h3>
                      <div class="box-tools pull-right">
                        <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>

                    <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                                <div class="form-group">
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox"> VATable
                                      </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox"> Accept Cheque
                                      </label>
                                    </div>
                                </div>  
                          </div>
                        </div><!--/.row-->
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                      <p class="pull-left text-red"><b>All fields are required</b></p>
                      <div class="form-group pull-right">
                        <div class="col-lg-5 input-group">
                          <span class="input-group-btn">
                            <button class="btn btn-info" type="button">Save</button>
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

  <!-- =============================================== -->

<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
