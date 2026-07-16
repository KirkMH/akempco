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
                      <h3 class="box-title"> Price Update</h3>
                      <div class="box-tools pull-right">
                        <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                      </div>                      
                    </div>
                    <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                  
                                  <div class="form-group ">
                                    <label>Bar Code</label>
                                    <input type="text" class="form-control" name="barCode" id="" placeholder="">
                                  </div>

                                  
                                  <div class="form-group ">
                                    <label>Description</label>
                                    <input type="text" class="form-control" name="description" id="" placeholder="">
                                  </div>

                                  
                                  <div class="form-group ">
                                    <label>Current Price</label>
                                    <input type="text" class="form-control" name="currentPrice" id="" placeholder="">
                                  </div>
                                  
                                  <div class="form-group ">
                                    <label>New Price</label>
                                    <input type="text" class="form-control" name="newPrice" id="" placeholder="">
                                  </div>

                                  <div class="form-group ">
                                    <label>Effectivity Date</label>
                                    <input type="text" class="form-control" name="effectivityDate" id="" placeholder="">
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

