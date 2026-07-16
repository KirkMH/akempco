<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <ul class="sidebar-menu">
      <li class="header" align="center"><e><img src="/akempco/images/logo_50.gif" /></e> </li>
      <li class="header">MAIN NAVIGATION</li>

      <li><a href="index.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>

      <!-- BEGIN RECORDS -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Records</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
<?php 
  if($_SESSION['login_member_role'] == "SUPERVISOR" || $_SESSION['login_member_role'] == "ADMINISTRATOR"){
    ?>
            <li><a href="regMember.php"><i class="fa fa-circle-o"></i> Members</a></li>
            <li><a href="regDepartment.php"><i class="fa fa-circle-o"></i> Departments</a></li>
            <li><a href="regGroupCredit.php"><i class="fa fa-circle-o"></i> Group Credit</a></li>
<?php 
  }
  ?>

<?php if($_SESSION['login_member_role'] == "SUPERVISOR" || $_SESSION['login_member_role'] == "INVENTORY" || $_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
            <li><a href="regSupplier.php"><i class="fa fa-circle-o"></i> Supplier</a></li>
            <li><a href="regProduct.php"><i class="fa fa-circle-o"></i> Products</a></li>
            <li><a href="regPackage.php"><i class="fa fa-circle-o"></i> Product Package</a></li>
            <li><a href="regGiftCertificate.php"><i class="fa fa-circle-o"></i> Gift Certificate</a></li>
<?php }?>
        </ul>
      </li>

      <!-- BEGIN generate -->
<?php if($_SESSION['login_member_role'] == "SUPERVISOR" || $_SESSION['login_member_role'] == "INVENTORY" || $_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Transactions</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

          <li><a href="purchases.php"><i class="fa fa-circle-o"></i> Purchases</a></li>
          <li><a href="BO.php"><i class="fa fa-circle-o"></i> Bad Orders</a></li>
          <li><a href="inventory-count.php"><i class="fa fa-circle-o"></i> Inventory Count</a></li>
          <!--<li><a href="genBarcode.php"><i class="fa fa-circle-o"></i> Generate Barcode</a></li>-->
<?php if($_SESSION['login_member_role'] == "SUPERVISOR" || $_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
  <!--        <li><a href="accountReceivables.php"><i class="fa fa-circle-o"></i> Account Receivables</a></li> -->
          <li><a href="creditPayment.php"><i class="fa fa-circle-o"></i> Credit Payment</a></li>
<?php } ?>
<?php if($_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
          <li><a href="inventoryAdjustment.php"><i class="fa fa-circle-o"></i> Inventory Adjustment</a></li>
<!--          <li><a href="creditPaymentAdjustment.php"><i class="fa fa-circle-o"></i> Credit Payment Adjustment</a></li>
<?php } ?> -->
        </ul>
      </li>
<?php }?>
      <!-- BEGIN generate -->
<?php if($_SESSION['login_member_role'] == "SUPERVISOR" || $_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Reports</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
		  <li><a href="salesReport.php"><i class="fa fa-circle-o"></i> Sales</a></li>
          <li><a href="productSalesReport.php"><i class="fa fa-circle-o"></i> Product Sales</a></li>
          <li><a href="inventoryReport.php"><i class="fa fa-circle-o"></i> Inventory</a></li>
          <?php if($_SESSION['login_member_role'] == "SUPERVISOR" || $_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
          <li><a href="accountReceivables.php"><i class="fa fa-circle-o"></i> Collectibles</a></li>
          <li><a href="memAcctInquiry.php"><i class="fa fa-circle-o"></i> Member's Transactions</a></li>
          <li><a href="grpAcctInquiry.php"><i class="fa fa-circle-o"></i> Group's Transactions</a></li>
          <li><a href="inventoryPurchases.php"><i class="fa fa-circle-o"></i> Inventory Purchases</a></li>
          <?php } ?>
          <?php if($_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
          <li><a href="auditTrail.php"><i class="fa fa-circle-o"></i> Audit Trail</a></li>
          <?php } ?>
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
    <?php if($_SESSION['login_member_role'] == "ADMINISTRATOR"){?>
          <li><a href="regUsers.php"><i class="fa fa-circle-o"></i> Users</a></li>
    <?php } ?>
        </ul>
      </li>
<?php }?>
  </section>
  <!-- /.sidebar -->
</aside>
