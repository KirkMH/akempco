<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FUSE | Marianing Superstore - Manager</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="dist/css/addons.css">
      </head>
      <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper POS">

          <header class="main-header">
            <!-- Logo -->
            <a href="login.html" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>FUSE</b></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>Marianing</b> Superstore</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
              <h4 style="float:left; margin-left:30px; margin-top:16px; color:#fff"><b> April 13, 2016 | 5:00:30 pm </b></h4>            

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
                      <span class="hidden-xs">Bonnie Vee</span>
                    </a>

                  </li>
                </ul>
              </div>
            </nav>
          </header>

          <!-- =============================================== -->

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
<!--             <section class="content-header">
              
            </section> -->

            <!-- Main content -->
            <section class="content">
              <div class="row">
                <!-- left column -->
                <div class="col-md-6">          

                  <!-- Default box -->
                  <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Sales Invoice # </h3>
                      <div class="pull-right">
                        <h3 class="box-title">2016-0413120530-000001</h3>
                      </div>
                    </div>

                    <div class="box-body">

                      <!-- CUSTOMER TYPE -->
                      <div class="form-group">
                        <label>Customer Type</label>
                        <select class="form-control">
                          <option>Walk-in</option>
                          <option>Group</option>
                          <option>Wholesale</option>
                        </select>
                      </div>

                      <!-- ITEMS -->
                      <div class="">
                          <!-- <h3 class="">ITEM</h3> -->
                          <input class="form-control input-sm" type="text" placeholder="ITEM Code">
                      </div><!-- /.box -->                      


                      <div class="table-responsive no-padding">
                        <table class="table table-hover">
                          <tr>
                            <th>#</th>
                            <th>Qty</th>
                            <th>UOM</th>
                            <th>Item Desc</th>
                            <th>Total</th>
                          </tr>
                          <tr>
                            <td>1786767883</td>
                            <td>5</td>
                            <td>kilos</td>
                            <td>sugar </td>
                            <td>76</td>
                            
                          </tr>
                          <tr>
                            <td>178786783</td>
                            <td>5</td>
                            <td>piece</td>
                            <td>candy</td>
                            <td>78</td>
                            
                          </tr>
                          <tr>
                            <td>458787735</td>
                            <td>5</td>
                            <td>box</td>
                            <td>snackbar</td>
                            <td>113</td>
                            
                          </tr>
                          <tr>
                            <td>987887677</td>
                            <td>7</td>
                            <td>can</td>
                            <td>555 sardines</td>
                            <td>87.99</td>
                            
                          </tr>
                          <tr>
                            <td>67787665</td>
                            <td>9</td>
                            <td>sack</td>
                            <td>flour</td>
                            <td>12.67</td>
                            
                          </tr>
                          <tr>
                            <td>658479537</td>
                            <td>5</td>
                            <td>liter</td>
                            <td>oil</td>
                            <td>23.50></td>
                            
                          </tr>                  
                          <tr>
                            <td>265650219</td>
                            <td>2</td>
                            <td>bottle</td>
                            <td>silver swan soy sauce</td>
                            <td>88</td>
                            
                          </tr>
                          <tr>
                            <td>655120747</td>
                            <td>1</td>
                            <td>pint</td>
                            <td>selecta ice cream</td>
                            <td>56</td>
                            
                          </tr>
                        </table>
                      </div><!-- /.box-body -->

                    </div><!-- /.box-body -->

                    <div class="box-footer ">
                      <!-- Footer -->
                    </div><!-- /.box-footer-->

                  </div><!-- /.box -->

                </div><!-- /.col-md-6 -->

                <div class="col-md-6">
                  <div class="box">
                    <div class="box-header">
                      <h1><b>Total:  </b> <b class="pull-right">P 535.16</b></h1>
                    </div>
                    <div class="box-body">
                      <h1><b>Tendered:  </b> <b class="pull-right">P 1000</b></h1>
                    </div>
                    <div class="box-footer ">
                      <h1><b>Change:  </b> <b class="pull-right">P 464.84</b></h1>
                      <!-- Footer -->
                    </div><!-- /.box-footer-->                    
                  </div>
                  <div class="box" >
                    <div class="box-body">
                      <div class="form-group">
                        <p class="help-block"><b>Minus(-) Asterisk(*) Item Code</b> Item Void</p>
                        <p class="help-block"><b>#38</b> Search</p>
                        <p class="help-block"><b>#39</b> Void Item</p>
                        <p class="help-block"><b>#40</b> Change Payment Mode</p>
                        <p class="help-block"><b>#41</b> Grant Discount</p>
                        <p class="help-block"><b>#42</b> Customer Type</p>
                        <p class="help-block"><b>#43</b> Bad Order</p>
                        <p class="help-block"><b>#44</b> Print Daily Sales</p>
                        <p class="help-block"><b>#45</b> Cancel Transaction</p>
                        <p class="help-block"><b>#45</b> Logout</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.row -->
            </section><!-- /.content -->

          </div><!-- /.content-wrapper -->

          <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <b>Version</b> 2.3.0
            </div>
            <strong>Copyright &copy; 2015-2016 <a href="http://f1itsystemsolutions.com">F1 IT System Solutions</a>.</strong> All rights reserved.
          </footer>


          <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
      </body>
      </html>
