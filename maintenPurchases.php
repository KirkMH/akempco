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
                
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"> Upload Purchases</h3>
                    <div class="box-tools pull-right">
                      <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                       
                  <div class="box-body">
                    <div class="col-lg-3">
                      <div class="input-group">
                        <a href="#">Download Template</a>
                        <input type="file">
                      </div><!-- /input-group -->
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                      <div class="form-group pull-right">
                        <div class="col-lg-5 input-group">
                            <span class="input-group-btn">
                              <button class="btn btn-info" type="button">Upload</button>
                            </span>
                        </div><!-- /input-group -->
                      </div><!-- /.form-group -->                 
                  </div><!-- /.box-footer-->
              </div>

              <!-- Default box -->
              <div class="box">
                <form action="">
                    <div class="box-header with-border">
                      <h3 class="box-title"> Purchase Entry</h3>
                      <div class="box-tools pull-right">
                        <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                      </div>                      
                    </div>
                    <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                  
                                  <div class="form-group ">
                                    <label>Bar Code</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                  </div>

                                  
                                  <div class="form-group ">
                                    <label>UOM</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                  </div>

                                  
                                  <div class="form-group ">
                                    <label>Supplier</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                  </div>
                                  
                                  <div class="form-group ">
                                    <label>Delivered Quantity</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                  </div>

                                  <div class="form-group ">
                                    <label>Delivery Date</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                  </div>                                  
                                </div>
                            </div>
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
              
            </div><!--/.col-md-12  -->
          </div><!-- /.row-->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>

