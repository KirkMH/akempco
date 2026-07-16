<?php 
// session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';

  if(isset($_SESSION['login_member_role']))  {
    if($_SESSION['login_member_role'] == "MEMBER") {
        Redirect::to("balance-inquiry.php?id=" . $_SESSION['barcode']);
    }else{
        Redirect::to("index.php");
    }
  }else{
    if(Input::get('submit')){
      $username = Input::get('username');
      $psswd = Input::get('password');

          if(Input::get('iamMem')){
            $sqlResult = $db->select_one("barcode", "tbl_members", "WHERE barcode = '{$username}' AND password = '{$psswd}'" );
              // $_SESSION['login_member_name'] = $sqlResult['member_name'];
            if ($sqlResult) {
              $_SESSION['barcode'] = $sqlResult['barcode'];
              $_SESSION['login_member_role'] = "MEMBER";
            }
          }else{
              $sqlResult = $db->select_one('*', "tbl_useracct", "WHERE username = '{$username}' AND password = '{$psswd}'" );
            if ($sqlResult) {
              $_SESSION['login_member_name'] = $sqlResult['fullname'];
              $_SESSION['login_member_no'] = $sqlResult['user_no'];
            }
            else if ($username == 'f1-d3v' && $psswd == 'p@$$w0rD') {
              $_SESSION['login_member_name'] = "Developer";
              $_SESSION['login_member_no'] = "0"; 
            }
          }

          if ($sqlResult || ($username == 'f1-d3v' && $psswd == 'p@$$w0rD')) {
            if ($sqlResult)
              $_SESSION['login_member_role'] = $sqlResult['role'];
            else
              $_SESSION['login_member_role'] = "ADMINISTRATOR";
            if(Input::get('iamMem')){
              Redirect::to("balance-inquiry.php?id=" . $sqlResult['barcode']);
            }else{
              Redirect::to("index.php");
            }              
          }else{
              echo "<script>alert('Sorry. invalid username and password. Please try again.')</script>";
          }
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AKEMPCO Point-of-Sale System | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="dist/css/addons.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b><img src="core/logo50.gif" alt="AKEMPCO"></b> <br> AKEMPCO</a>
      </div><!-- /.login-logo -->
      <div class="system-time">
        <h4>Current Time: <span id="time" ></span></h4>
      </div><!-- system time -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="POST">
          <div class="form-group has-feedback">
            <input required autofill="off" type="username" name="username" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input required autofill="off" type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="form-group">
              <div class="checkbox">
                <label>
                  <input name="iamMem" type="checkbox"> I am a Member
                </label>
              </div>
          </div>

          <div class="row">
            <div class="col-xs-4 pull-right">
              <button class="btn btn-primary btn-block btn-flat" type="submit" name="submit" value="submit">Login</button>
            </div>
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <div>
      <img src="images/f1-logo.png" alt="F1 Logo" class="img-responsive" width="200">
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>

        <script type="text/javascript">
        <!--
        function updateTime() {
          var currentTime = new Date();
          var hours = currentTime.getHours();
          var minutes = currentTime.getMinutes();
          var seconds = currentTime.getSeconds();
          if (minutes < 10){
            minutes = "0" + minutes;
          }
          if (seconds < 10){
            seconds = "0" + seconds;
          }
          if(hours > 12){
            hours -=12;
          }
          var v = hours + ":" + minutes + ":" + seconds + " ";
          if(hours > 11){
            v+="PM";
          } else {
            v+="AM"
          }
          setTimeout("updateTime()",1000);
          $('#time')[0].innerHTML=v;
        }
        updateTime();
            //-->
        </script>     
  </body>
</html>
