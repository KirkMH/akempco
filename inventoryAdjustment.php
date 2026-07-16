
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

$table = 'tbl_purchases';
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

        <!-- Default box -->
   
<!--
        <div class="box">
          <div class="box-header">
            <h3>Upload CSV file</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div>


          <div class="box-body">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="">Select Action</label> 
                <select class="form-control">
                  <option selected="selected">Select Action</option>
                  <option>Add Bulk Members</option>
                  <option>Update Payment Records</option>
                </select>
              </div>  

              <div class="input-group">
                <input type="file">
              </div>
            </div>
          </div>

          <div class="box-footer">
            <div class="form-group pull-right">
              <div class="col-lg-5 input-group">
                <span class="input-group-btn">
                  <button class="btn btn-info" type="button">Save</button>
                </span>
              </div>
            </div>
          </div>
        </div>
 -->

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Inventory Adjustment</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
           
            <table id="tbl_groupcredit" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTION</th>
                  <th>Supplier Name</th>
                  <th>Invoice Number</th>
                  <th>Invoice Date</th>
                 
                </tr>
              </thead>
              <tbody>                      
                <?php 
                $sqlResult = $db->select('tbl_purchases.*,tbl_supplier.sup_name', $table, 'INNER JOIN tbl_supplier ON tbl_supplier.sup_no = tbl_purchases.sup_no ORDER BY tbl_purchases.invoice_date DESC');
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  ?>
                  <tr>
                    <td> 
                      <a href="/akempco/purchase-details.php?id=<?php echo $dataAttri['purchase_id']; ?>">View</a> <br>
                      </td>
                      <td><?php echo $dataAttri['sup_name'];?></td>
                      <td><?php echo $dataAttri['ref_no'];?></td>
                      <td><?php echo $dataAttri['invoice_date'];?></td>
                     
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
