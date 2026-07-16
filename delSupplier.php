<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

  $table = 'tbl_supplier';
  $filter = 'sup_no';
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Delisted Suppliers</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>                  
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group"><input type="button" onclick="location.href='regSupplier.php'" value="View Active Suppliers" /></div>
            <table id="tbl_supplier" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                 <th>ACTIONS</th>
                 <th>Name</th>
                 <th>Address</th>
                 <th>TIN</th>
                 <th>Business Type</th>
                 <th>Tax Type</th>
                 <th>Contact Person</th>
                 <th>Contact Number</th>
                 <th>Discounts</th>
               </tr>
             </thead>
             <tbody>

              <?php 
              $sqlResult = $db->select('*', $table, 'WHERE active = 0 ORDER BY sup_name');

              while ($dataAttri = $sqlResult->fetch_assoc()) {
                $dataID = $dataAttri['sup_no'];
                ?>
                <tr>
                  <td><a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter?>&dataID=<?php echo $dataID; ?>&active=1" onclick="return (confirm('Are you sure you want to restore this supplier?'));">RESTORE</a></td>
                  
                  <td><?php echo ucfirst($dataAttri['sup_name']);?></td>
                  <td><?php echo ucfirst($dataAttri['sup_address']); ?></td>
                  <td> <?php echo $dataAttri['TIN'];?></td>
                  <td><?php echo $dataAttri['bus_type'];?></td>
                  <td><?php echo $dataAttri['tax_type'];?></td>
                  <td><?php echo ucfirst($dataAttri['contact_person']);?></td>
                  <td><?php echo $dataAttri['contact_no'];?></td>
                  <td align="right"><?php echo $dataAttri['discount'];	?>%</td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </div>  
  </div><!-- row-->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
