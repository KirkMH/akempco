
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

$table = 'tbl_groupcredit';
$table2 = 'tbl_groupmembers';
$filter = 'group_no';
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
            <h3 class="box-title">Delisted Group Credit</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group"><input type="button" onclick="location.href='regGroupCredit.php'" value="View Active Group Credits" /></div>
            <table id="tbl_members" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTIONS</th>
                  <th>Group Name</th>
                  <th>Head Name</th>
                  <th>Contact No.</th>
                  <th>No. of Members</th>
                  <th>Credit Limit</th>
                  <th>Remaining Credit</th>
                </tr>
              </thead>
              <tbody>                      
                <?php 
                $sqlResult = $db->select('*', $table, 'WHERE active = 0 ORDER BY group_name');
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  ?>
                  <tr>
                    <td> 
                      <a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter?>&dataID=<?php echo $dataAttri['group_no']; ?>&active=1" onclick="return (confirm('Are you sure you want to restore this group credit?'));">RESTORE GROUP</a></td>
                      <td><?php echo $dataAttri['group_name'];?></td>
                      <td><?php echo $dataAttri['headName'];?></td>
                      <td><?php echo $dataAttri['contact_no'];?></td>
                      <td align="right"><?php echo $dataAttri['num_members'];?></td>
                      <td align="right"><?php echo number_format($dataAttri['credit_limit'], 2, ".", ",");?></td>
                      <td align="right"><?php echo number_format($dataAttri['charge_total'], 2, ".", ",");?></td>
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
