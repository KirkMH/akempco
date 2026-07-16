      <body class="hold-transition skin-red sidebar-mini fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
          <header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>POS</b></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"> AKEMPCO POS </span>
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

              <h4 style="float:left; margin-left:30px; margin-top:16px; color:#fff"><b> 
                <?php 
                    echo date("M d Y") . " | <span id='time' ></span>";
                    ?>
              </b></h4>    
                            
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <li class="dropdown notifications-menu">
<!--                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning">4</span>
                    </a> -->
<!--                     <ul class="dropdown-menu">
                     <li class="header">You have 4 notifications</li>
                      <li>
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
                    </ul>-->
                  </li> 

                  <li class="dropdown user user-menu">
                    <a href="account.php" class="dropdown-toggle" >
                      <span class="hidden-xs">Welcome <?php echo ucfirst($_SESSION['login_member_name']);?></span>
                    </a>
                  </li>

                  <li>
                    <a href="/akempco/logout.php">
                      <span class="hidden-xs">Log-out</span>
                    </a>
                  </li>

                </ul>
              </div>
            </nav>
          </header>