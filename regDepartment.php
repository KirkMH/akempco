<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
  $table = 'tbl_department';
  $filter = 'dept_no';

  $validate = new Validate();
  if(Token::check(Input::get('token'))){
    $dataID = $db->escape(Input::get('dataID'));

        if(Input::get('action') == 'insert'){
          $validation = $validate->check($_GET, array(
            'dept_name' => array(
              'tag_name' => 'Department Name', 
              'required' => true,
              'unique' => 'tbl_department',
              'min' => 2,
              'max' => 50
              )
          ));

        }else if(Input::get('action') == 'update'){
          $validation = $validate->check($_GET, array(
            'dept_name' => array(
              'tag_name' => 'Department Name', 
              'required' => true,
              'min' => 2,
              'max' => 50
              )
            ));
        }

        if($validation->passed()){
            require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/processor.php';
            // Redirect::to('/akempco/includes/processor.php');
        }else{
          foreach ($validation->errors() as $errorKey => $errorVal) {
            Session::flash('err', $errorVal);
            break;
          }
        }
    /*}*/
  }
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $token = Token::generate();
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
                  }else if(Session::exists('err')){
                  ?>
                    <div class="alert alert-danger alert-dismissable">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                      <h4>  <i class="icon fa fa-check"></i> <?php  echo Session::flash('err') ?></h4>
                    </div>
                  <?php 
                  }
                  ?>

          <!-- Default box -->
          <div class="box">
<form class="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . (Input::get('dept_no') ?  "?action=update" : "") ?>" method="GET" >
            <!-- <form action="/akempco/includes/processor.php?<?php //echo Input::get('dept_no') ?  "action=update" : "" ?>" method="GET" > -->
              <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo Input::get('dept_no') ?  "Update Department" : "Add New Department"; ?> </h3>
                <div class="box-tools pull-right">
                  <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                    <input name="action" value="<?php echo Input::get('dept_no') ?  'update' : 'insert'; ?>"  type="hidden">
                    <input name="dataID" value="<?php echo Input::get('dept_no') ?  $_GET['dept_no'] : ''; ?>"  type="hidden">
                    <input name="filter" value="<?php echo Input::get('dept_no') ?  'dept_no' : ''; ?>"  type="hidden">
                    <input name="table" value="<?php echo $table; ?>" type="hidden">
                    <div class="form-group ">
                      <label>Department/Division Name</label>
                      <input required value="<?php echo Input::get('dept_name') ?>" type="text" class="form-control" name="dept_name" placeholder="">
                    </div>
                    
                    <div class="form-group ">
                      <label>Description</label>
                      <input value="<?php echo Input::get('dept_desc') ?>" type="text" class="form-control" name="dept_desc" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Status</label>
                      <select required class="form-control" name="active">
                        <option value="">Select Status</option>
                        <option <?php echo Input::get('active') == '1' ? 'selected="selected"' : '' ?> value="1" >Active</option>
                        <option <?php echo Input::get('active') == '0' ? 'selected="selected"' : '' ?> value="0" >Inactive</option>
                      </select>
                    </div> 
                    
                  </div>

                </div><!--/.row-->
              </div><!-- /.box-body -->

              <div class="box-footer">
                <p class="pull-left text-red"><b>All fields are required</b></p>
                <div class="form-group pull-right">
                  <div class="col-lg-5 input-group">
                    <span class="input-group-btn">
                      <button id="clear" class="btn btn-info" type="button" name="clear" value="clear" >Clear</button>
                    </span>
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info" type="button" name="submit" value="save">Save</button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.form-group -->                 
              </div><!-- /.box-footer-->

            </form>
          </div><!-- /.box -->


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Registered Departments</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="form-group"><input type="button" onclick="location.href='inactiveDepartment.php'" value="View Delisted Departments" /></div>
              <table id="listTable" class="sorttable table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ACTION</th>
                    <th>Department Name</th>
                    <th>Description</th>
                    <th>Active</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sqlResult = $db->select('*', $table, 'WHERE active = 1 ORDER BY dept_name');
                  if($sqlResult){
                    while ($dataAttri = $sqlResult->fetch_assoc()) {
                      $dataID = $dataAttri['dept_no'];
                      ?>
                      <tr>
                        <td> <a href="/akempco/includes/select.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?>">UPDATE</a> |
                         <a href="/akempco/includes/delist.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?>&active=0" onclick="return (confirm('Are you sure you want to delist this department?'));">DELIST</a></td>
                         <td><?php echo ucfirst($dataAttri['dept_name']);?></td>
                         <td><?php echo ucfirst($dataAttri['dept_desc']);?></td>
                         <td><?php echo ($dataAttri['active'] == 1) ?"Yes":"No" ;?></td>
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
