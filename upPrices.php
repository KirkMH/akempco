<?php
 include_once '../core/init.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FUSE | Marianing Superstore -  Inventory Staff 1</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo SITE_URL_FILE; ?>dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL_FILE; ?>dist/css/addons.css">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>FUSE</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Marianing</b> Superstore</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-file-pdf-o text-aqua"></i> 5 pending documents for approval
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-file-pdf-o text-aqua"></i> March sales report ready
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> Added new approved group credit
                        </a>
                      </li>                                                                 
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                  <span class="hidden-xs">Inventory Staff 1</span>
                </a>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            
            <!-- BEGIN REGISTER -->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Register</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Supplier</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Products</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Package for Sale</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Approved Group Credit</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Approved Key Customer</a></li>

              </ul>
            </li> 
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
          <div class="row">


              <!-- Default box -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Key Customer Registration</h3>
                </div>
                <!-- ./title -->

                <div class="box-body">
                  <form action="">
                      <!-- ROW 1 STARTS HERE -->
                        <div class="col-md-12">
                      <div class="form-group">
                        <label>Key Customer Code</label>
                        <input type="text" class="form-control" placeholder="7897867856" disabled>
                      </div>                

                      <!-- input states -->
                      <div class="form-group "><!-- has-success -->
                        <!-- <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Supplier Name</label> -->
                        <input type="text" class="form-control" id="inputSuccess" placeholder="Key Customer Name">
                      </div>

                      <!-- input states -->
                      <div class="form-group "><!-- has-success -->
                        <input type="text" class="form-control" id="inputSuccess" placeholder="Address">
                      </div>

                      <!-- input states -->
                      <div class="form-group "><!-- has-success -->
                        <input type="text" class="form-control" id="inputSuccess" placeholder="Tax Identification No.">
                      </div>

                      <!-- input states -->
                      <div class="form-group "><!-- has-success -->
                        <input type="text" class="form-control" id="inputSuccess" placeholder="Nature of Business">
                      </div>


                        </div><!-- /.col-md-6-->
                      <!-- ROW 2 ENDS HERE -->
                  </form>
                </div><!-- /.box-body -->


                <div class="box-footer">
                  NOTE: Credit Terms not yet included
                </div><!-- /.box-footer-->
              </div><!-- /.box -->



          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://f1itsystemsolutions.com">f1 IT System Solutions</a>.</strong> All rights reserved.
      </footer>


    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo SITE_URL_FILE; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo SITE_URL_FILE; ?>bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo SITE_URL_FILE; ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo SITE_URL_FILE; ?>plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo SITE_URL_FILE; ?>dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo SITE_URL_FILE; ?>dist/js/demo.js"></script>
  </body>
</html>
