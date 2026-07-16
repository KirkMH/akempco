<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>

      <li><a href="index.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>

      <!-- BEGIN RECORDS -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Records</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="balance-inquiry.php"><i class="fa fa-circle-o"></i> Balance Inquiry</a></li>
<?php 
  if($_SESSION['login_member_role'] == 2 || $_SESSION['login_member_role'] == 1){
    ?>
            <li><a href="regMember.php"><i class="fa fa-circle-o"></i> Members</a></li>
            <li><a href="regDepartment.php"><i class="fa fa-circle-o"></i> Departments</a></li>
            <li><a href="regGroupCredit.php"><i class="fa fa-circle-o"></i> Group Credit</a></li>
<?php 
  }
  ?>

<?php if($_SESSION['login_member_role'] == 5 || $_SESSION['login_member_role'] == 1){?>
            <li><a href="regSupplier.php"><i class="fa fa-circle-o"></i> Supplier</a></li>
            <li><a href="regProduct.php"><i class="fa fa-circle-o"></i> Products</a></li>
            <li><a href="regPackage.php"><i class="fa fa-circle-o"></i> Product Package</a></li>
            <li><a href="regGiftCertificate.php"><i class="fa fa-circle-o"></i> Gift Certificate</a></li>
<?php }?>
        </ul>
      </li>

      <!-- BEGIN generate -->
<?php if($_SESSION['login_member_role'] == 5 || $_SESSION['login_member_role'] == 1){?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Transactions</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

          <li><a href="purchases.php"><i class="fa fa-circle-o"></i> Purchases</a></li>
          <li><a href="BO.php"><i class="fa fa-circle-o"></i> Bad Orders</a></li>
          <li><a href="inventory-count.php"><i class="fa fa-circle-o"></i> Inventory Count</a></li>
          <li><a href="genBarcode.php"><i class="fa fa-circle-o"></i> Generate Barcode</a></li>
        </ul>
      </li>
<?php }?>
      <!-- BEGIN generate -->
<?php if($_SESSION['login_member_role'] == 2 || $_SESSION['login_member_role'] == 1){?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Reports</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="salesReport.php"><i class="fa fa-circle-o"></i> Sales</a></li>
          <li><a href="inventoryReport.php"><i class="fa fa-circle-o"></i> Inventory</a></li>
        </ul>
      </li>
      <!-- BEGIN generate -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Settings</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="regUOM.php"><i class="fa fa-circle-o"></i> UOM</a></li> -->
          <li><a href="discounts.php"><i class="fa fa-circle-o"></i> Discounts</a></li>
          <li><a href="features.php"><i class="fa fa-circle-o"></i> Features</a></li>
          <li><a href="regUsers.php"><i class="fa fa-circle-o"></i> Users</a></li>
        </ul>
      </li>
<?php }?>

  </section>
  <!-- /.sidebar -->
</aside>