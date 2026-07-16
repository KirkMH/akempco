<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_giftcert';
  $filter = 'gc_no';
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
                      <h3 class="box-title"> Generate Gift Certificate</h3>
                      <div class="box-tools pull-right">
                        <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>

                    <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                            
                            <div class="form-group ">
                              <label>Control Number Range: Start</label>
                              <input required type="text" class="form-control" id="" placeholder="">
                            </div>
                            
                            <div class="form-group ">
                              <label>Control Number Range: End</label>
                              <input required type="text" class="form-control" id="" placeholder="">
                            </div>
                            
                            <div class="form-group ">
                              <label>Amount</label>
                              <input required type="text" class="form-control" id="" placeholder="">
                            </div>
                            <div class="form-group ">
                              <label>Quantity</label>
                              <input required type="text" class="form-control" id="" placeholder="">
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


              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Registered Gift Certificate</h3>
                  <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="listTable" class="table table-responsive table-bordered table-striped">
                    <thead>
                      <tr>
                              <th>Control Number</th>
                              <th>Amount</th>
                              <th>Generations Date</th>
                              <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sqlResult = $db->select('*', $table);
                      while ($dataAttri = $sqlResult->fetch_assoc()) {
                        ?>
                        <tr>
                           <td><?php echo $dataAttri['con_no'];?></td>
                           <td><?php echo $dataAttri['amount'];?></td>
                           <td><?php echo $dataAttri['genDate'];?></td>
                           <td><?php echo $dataAttri['used'] == 1 ? "returned" : "";?></td>
                         </tr>
                         <?php
                       }
                       ?>
                     </tbody>
                   </table>
                 </div><!-- /.box-body -->
               </div><!-- /.box -->              
             </div><!--/.col-md-12  -->


            </div>  
          </div><!-- row-->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

  <!-- =============================================== -->

<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
