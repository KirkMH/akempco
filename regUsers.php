<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';

  $validate = new Validate();
  if(Token::check(Input::get('token'))){
    $dataID = $db->escape(Input::get('dataID'));

        if(Input::get('action') == 'insert'){
          $validation = $validate->check($_GET, array(
            'fullname' => array(
              'tag_name' => 'Full Name', 
              'required' => true,
              'unique' => 'tbl_useracct'
              ),
            'username' => array(
              'tag_name' => 'username', 
              'required' => true,
              'unique' => 'tbl_useracct'
              )
          ));

        }else if(Input::get('action') == 'update'){
          $validation = $validate->check($_GET, array(
            'fullname' => array(
              'tag_name' => 'Full Name', 
              'required' => true,
              ),
            'username' => array(
              'tag_name' => 'username', 
              'required' => true,
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
  $table = 'tbl_useracct';
  $filter = 'user_no';
  $dept_no = 0;
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
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
        <form class="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . (Input::get('user_no') ?  "?action=update" : "") ?>" method="GET" >
            <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Input::get('user_no') ?  "Update User" : "User Registration"; ?> </h3>
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
		<input name="accessLevel" value="1" type="hidden">
		<?php //if(Input::get('user_no')){ ?>
<!--			<input name="password" value="<?php //echo Input::get('password'); ?>" type="hidden">-->
		<?php// } ?>
                  <div class="form-group ">
                    <label>Full Name</label>
                    <input required  value="<?php echo Input::get('fullname') ?  $_GET['fullname'] : ''; ?>"  type="text" class="form-control" name="fullname" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Username</label>
                    <input required=""  value="<?php echo Input::get('username') ?  $_GET['username'] : ''; ?>"  type="text" class="form-control" name="username" id="" placeholder="">
                  </div>

                  <?php
                    if(!Input::get('user_no')){
                  ?>
                      <div class="form-group">
                        <label>Temporary Password</label>
                        <input value="<?php echo randomPassword(); ?>" type="text" class="form-control" name="password" id="" placeholder="">
                      </div>
                  <?php 
                    }
                  ?>
                </div>

                <div class="col-md-6">
                  <div class="form-group ">
                    <label>Role</label>
                      <select required class="form-control" name="role">
                        <option value="">Select Department</option>
                        <option <?php echo Input::get('role') == 'CASHIER' ? 'selected="selected"' : '' ?> value="CASHIER">CASHIER</option>
                        <option <?php echo Input::get('role') == 'INVENTORY' ? 'selected="selected"' : '' ?> value="INVENTORY">INVENTORY</option>
                        <option <?php echo Input::get('role') == 'SUPERVISOR' ? 'selected="selected"' : '' ?> value="SUPERVISOR">SUPERVISOR</option>
                        <option <?php echo Input::get('role') == 'ADMINISTRATOR' ? 'selected="selected"' : '' ?> value="ADMINISTRATOR">ADMINISTRATOR</option>
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
                          <input <?php echo (Input::get('override')) ? "checked" : "" ;?> type="checkbox" name="override"> Permission to override
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

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Registered System Users</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="tbl_members" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTIONS</th>
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Permission To Override</th>
                </tr>
              </thead>
              <tbody>                      
                <?php 
                $sqlResult = $db->select('*', $table, 'WHERE active = 1 AND user_no <> '. $_SESSION['login_member_no']. ' ORDER BY active DESC');
              // $sqlResult = $db->select('tm.member_no, tm.member_name, UA.username, R.role_name, UA.override', $table . " AS UA", "INNER JOIN roles AS R ON UA.role_id = R.role_id WHERE UA.active = 1");                
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['user_no'];
                  ?>
                  <tr>
                    <td>
                      <a href="/akempco/includes/select.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID?> ">UPDATE</a> |
                      <a href="/akempco/includes/delist.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID ?>&active=0">DELIST</a>
                      </td>
                     <td><?php echo $dataAttri['fullname'];?></td>
                     <td><?php echo $dataAttri['username'];?></td>
                     <td><?php echo $dataAttri['role'];?></td>
                     <td><?php echo ($dataAttri['override'] == 1) ?"Yes":"No" ;?></td>
                   </tr>
                   <?php
                 }
                 ?>
               </tbody>
             </table>
           </div><!-- /.box-body -->
         </div><!-- /.box --> 
       </div>
     </div>
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
