<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_discount';
  $filter = 'disc_no';
/*  $errorsList = array();
    $validate = new Validate();
    if(Token::check(Input::get('token'))){


    $validation = $validate->check($_GET, array(
      'dept_name' => array(
        'tag_name' => 'Department Name', 
        'required' => true,
        'min' => 6,
        'max' => 60
        )
      
      
      ));

    // if(Input::get('old_pass')){
    //   $validate->addError("Please select where this menu is prepare.");
    // }

    if($validation->passed()){
      require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/processor.php';
    }else{
      foreach ($validation->errors() as $errorKey => $errorVal) {
        $errorsList[$errorKey] = $errorVal;
      }      
    }
  }*/
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
                <form action="/akempco/includes/processor.php?<?php echo Input::get('uom_no') ?  "action=update" : "" ?>" method="GET">
                  <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
                    <div class="box-header with-border">
                      <h3 class="box-title"><?php echo Input::get('uom_no') ?  "Update Discount" : "Add New Discount"; ?> </h3>
                      <div class="box-tools pull-right">
                        <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>

                    <div class="box-body">
                        <div class="row">
                          <div class="col-md-6">
                            <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                            <input name="action" value="<?php echo Input::get('disc_no') ?  'update' : 'insert'; ?>"  type="hidden">
                            <input name="dataID" value="<?php echo Input::get('disc_no') ?  Input::get('disc_no') : ''; ?>"  type="hidden">
                            <input name="filter" value="<?php echo Input::get('disc_no') ?  'disc_no' : ''; ?>"  type="hidden">
                            <input name="table" value="<?php echo $table; ?>" type="hidden">
                            <div class="form-group ">
                              <label>Discounts</label>
                              <input value="<?php echo Input::get('disc_description') ?>" type="text" class="form-control" name="disc_description" placeholder="">
                            </div>
                            
                            <div class="form-group ">
                              <label>Percentage (%)</label>
                              <input value="<?php echo Input::get('percentage') ?>" type="text" class="form-control" name="percentage" placeholder="">
                            </div>

                            <div class="form-group">
                              <label>Less VAT First (if VATable)</label>
                              <select class="form-control" name="active">
                                <!-- <option >Select Status</option> -->
                                <option <?php echo Input::get('active') == '1' ? 'selected="selected"' : '' ?> value="1" >Yes</option>
                                <option <?php echo Input::get('active') == '0' ? 'selected="selected"' : '' ?> value="0" >No</option>
                              </select>
                            </div> 

                            <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="active">
                                <!-- <option >Select Status</option> -->
                                <option <?php echo Input::get('active') == '1' ? 'selected="selected"' : '' ?> value="1" >Active</option>
                                <option <?php echo Input::get('active') == '0' ? 'selected="selected"' : '' ?> value="0" >Inactive</option>
                              </select>
                            </div> 
                                
                            <!-- Should have something here to store the user_no of the one doing this -->

                          </div>

                        </div><!--/.row-->
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                      <p class="pull-left text-red"><b>* Required fields</b></p>
                      <div class="form-group pull-right">
                        <div class="col-lg-5 input-group">
                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-info" type="button">Save</button>
                          </span>
                        </div><!-- /input-group -->
                      </div><!-- /.form-group -->                 
                    </div><!-- /.box-footer-->

                </form>
              </div><!-- /.box -->


              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Registered Discounts</h3>
                  <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="listTable" class="sorttable table table-bordered table-striped">
                    <thead>
                      <tr>
                              <th>ACTION</th>
                              <th>Discount</th>
                              <th>Percentage</th>
                              <th>Less from VAT first?</th>
                              <th>Active</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sqlResult = $db->select('*', $table, 'ORDER BY active DESC');
                      if($sqlResult){
                        while ($dataAttri = $sqlResult->fetch_assoc()) {
                          $dataID = $dataAttri['disc_no'];
                          ?>
                          <tr>
                            <td> <a href="/akempco/includes/processor.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?> ">UPDATE</a> |
                               <a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?>&active=0">DELIST</a></td>
                             <td><?php echo ucfirst($dataAttri['disc_description']);?></td>
                             <td align='right'><?php echo ucfirst($dataAttri['percentage']);?>%</td>
                             <td align='center'><?php echo ($dataAttri['lessVAT'] == 1) ?"Yes":"No" ;?></td>
                             <td align='center'><?php echo ($dataAttri['active'] == 1) ?"Yes":"No" ;?></td>
                           </tr>
                           <?php
                         }
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
