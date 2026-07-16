<?php
// session_start();
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
  if(!isset($_SESSION['barcode'])) {
          Redirect::to("login.php");
  }      
  $table = "tbl_members";
  $validate = new Validate();
  if(Token::check(Input::get('token'))){
    $dataID = $db->escape(Input::get('dataID'));


        $validation = $validate->check($_GET, array(
          'password' => array(
            'tag_name' => 'Password', 
            'required' => true,
            'min' => 2,
            'max' => 20
            )
          ));

        if($validation->passed()){
            require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/processor.php';
            // Redirect::to('/akempco/includes/processor.php');
        }else{
          foreach ($validation->errors() as $errorKey => $errorVal) {
            Session::flash('err', $errorVal);
          }
        }
    /*}*/
  }
$token = Token::generate();
$sqlResult = $db->select_one("*", "tbl_members", "WHERE barcode=" . $_SESSION['barcode']);
?>
<!-- =============================================== -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAK | MEMBER BALANCE INQUIRY</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php  ?>dist/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="dist/css/addons.css">
  </head>
  <body class="hold-transition login-page">
    <div class="col-md-2">
      <!-- <img src="core/logo50.gif" alt="F1 Logo" class="img-responsive" > -->
    </div>
    <div class="col-md-2 pull-right">
      <!-- <img src="core/logo50.gif" alt="F1 Logo" class="img-responsive" > -->
      
    </div> 



<!-- Content Wrapper. Contains page content -->
<div class="">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      <h3><a href="balance-inquiry.php?id= <?php echo $_SESSION['barcode']; ?> "> Back to Balanace Inquiry page</a></h3>
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
<form class="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?action=update" ?>" method="GET" >
          
            <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
            <div class="box-header with-border">
              <h3 class="box-title">Update your Account</h3>
                  <div class="box-tools pull-right">
                    <h4>Welcome
                         <?php
                            echo ucfirst($sqlResult['member_name']);?> 
                      |
                      <a class="" href="logout.php">Logout</a></h4>
                  </div>
            </div>
            <!-- ./title -->

            <div class="box-body">
              <div class="row">
                <!-- ROW 1 STARTS HERE -->
                <div class="col-md-6">
                  <input name="action" value="update"  type="hidden">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="dataID" value="<?php echo $_SESSION['barcode']; ?>"  type="hidden">
                  <input name="filter" value="barcode"  type="hidden">
                  <input name="table" value="<?php echo $table; ?>" type="hidden">
                  <?php 
                    if(Session::exists('msg')){
                  ?>
                    <div class="alert alert-success alert-dismissable">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                      <h4>  <i class="icon fa fa-check"></i> <?php echo Session::flash('msg') ?></h4>
                    </div>
                  <?php 
                  }
                  ?>

                  <?php 
                    
                    
                  ?>

                  <div class="form-group ">
                    <label>Full Name </label>
                    <label style="color:#00ACD6; padding-left:10px; font-size:20px"><?php echo ucfirst($sqlResult['barcode']); ?></label>
                  </div>

                  <div class="form-group ">
                    <label>Username </label>
                    <label style="color:#00ACD6; padding-left:10px; font-size:20px"><?php echo ucfirst($sqlResult['member_name']); ?></label>
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

      </div><!-- /.col-md-12 --> 
  </div><!-- row-->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

    <div>
      <img src="images/f1-logo.png" alt="F1 Logo" class="img-responsive" width="200">
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
   
  </body>
</html>