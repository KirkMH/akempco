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

                  <?php 
                    if(Session::exists('msg')){
                  ?>
                    <div class="alert alert-success alert-dismissable">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                      <h4>  <i class="icon fa fa-check"></i> <?php  echo Session::flash('msg') ?></h4>
                    </div>
                  <?php 
                  }
                  ?>
        <!-- Default box -->
        <div class="box">
          <form action="/<?php echo basename(__DIR__); ?>/includes/processor.php?<?php echo isset($_GET['sup_no']) ?  "action=update" : ""; ?>;" method="GET">
            <div class="box-header with-border">
              <h3 class="box-title"> <?php echo isset($_GET['sup_no']) ?  "Update Supplier" : "Add New Supplier"; ?></h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>
            </div>

            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <input name="action" value="<?php echo isset($_GET['sup_no']) ?  'update' : 'insert'; ?>"  type="hidden">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="dataID" value="<?php echo isset($_GET['sup_no']) ?  $_GET['sup_no'] : ''; ?>"  type="hidden">
                  <input name="filter" value="<?php echo isset($_GET['sup_no']) ?  'sup_no' : ''; ?>"  type="hidden">
                  <input name="table" value="tbl_supplier" type="hidden">

                  <div class="form-group ">
                    <label>Supplier Name</label>
                    <input required value="<?php echo isset($_GET['sup_name']) ?  $_GET['sup_name'] : ''; ?>"  name="sup_name"  type="text" class="form-control" id="" placeholder="">
                  </div>
                  <div class="form-group ">
                    <label>Address</label>
                    <input required required value="<?php echo isset($_GET['sup_address']) ?  $_GET['sup_address'] : ''; ?>"  name="sup_address" type="text" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Tax Identification No.</label>
                    <input required value="<?php echo isset($_GET['TIN']) ?  $_GET['TIN'] : ''; ?>" name="TIN"  type="text" class="form-control" data-inputmask="'mask': ['999-999-999-999']" data-mask="" >
                  </div>


                  <div class="form-group">
                    <select required class="form-control" name="bus_type">
                      <option value="">Select Business Type</option>
                      <option <?php echo isset($_GET['bus_type']) ?  ($_GET['bus_type'] == 'Individual' ? 'selected="selected"' : '') : '';?> >Individual</option>
                      <option <?php echo isset($_GET['bus_type']) ?  ($_GET['bus_type'] == 'Corporate' ? 'selected="selected"' : '') : '';?> >Corporate</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <select required class="form-control" name="tax_type">
                    <option value="">Select TAX Type</option>
                      <option <?php echo isset($_GET['tax_type']) ?  ($_GET['tax_type'] == 'VAT' ? 'selected="selected"' : '') : '';?>>VAT</option>
                      <option <?php echo isset($_GET['tax_type']) ?  ($_GET['tax_type'] == 'VAT-Exempt' ? 'selected="selected"' : '') : '';?>>VAT-Exempt</option>
                      <option <?php echo isset($_GET['tax_type']) ?  ($_GET['tax_type'] == 'Percentage Tax' ? 'selected="selected"' : '') : '';?>>Percentage Tax</option>
                    </select>
                  </div>

                </div>

                <div class="col-md-6">
                  <div class="form-group ">
                    <label>Contact Person</label>
                    <input required value="<?php echo isset($_GET['contact_person']) ?  $_GET['contact_person'] : ''; ?>" name="contact_person"  type="text" class="form-control" id="" placeholder="">
                  </div>
                  <div class="form-group ">
                    <label>Contact Number</label>
                    <input required value="<?php echo isset($_GET['contact_no']) ?  $_GET['contact_no'] : ''; ?>" name="contact_no" type="text" class="form-control" id="" placeholder="">
                  </div>
                  <div class="form-group">
                    <label>Discount (in percent)</label>
                    <div class="col-lg-6 input-group">
                      <input required value="<?php echo isset($_GET['discount']) ?  $_GET['discount'] : '0'; ?>" name="discount" type="text" class="form-control" placeholder="" alt="Place zero when none">
                    </div><!-- /input-group -->
                  </div><!-- /.form-group -->
                  <div class="form-group">
                  <label>Status</label>
                    <select required class="form-control" name="active">
                      <option value="">Select Status</option>
                      <option <?php echo isset($_GET['active']) ?  ($_GET['active'] == '1' ? 'selected="selected"' : '') : '';?> value="1" >Active</option>
                      <option <?php echo isset($_GET['active']) ?  ($_GET['active'] == '0' ? 'selected="selected"' : '') : '';?> value="0" >Inactive</option>
                    </select>
                  </div>   
                </div>

              </div><!--/.row-->
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


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Registered Suppliers</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>                  
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group"><input type="button" onclick="location.href='delSupplier.php'" value="View Delisted Suppliers" /></div>
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
                 <th>Active</th>
               </tr>
             </thead>
             <tbody>

              <?php 
              $sqlResult = $db->select('*', $table, 'WHERE active = 1 ORDER BY sup_name');

              while ($dataAttri = $sqlResult->fetch_assoc()) {
                $dataID = $dataAttri['sup_no'];
                ?>
                <tr>
                  <td> <a href="/akempco/includes/processor.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter?>&dataID=<?php echo $dataID; ?> ">UPDATE</a> | <a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter?>&dataID=<?php echo $dataID; ?>&active=" onclick="return (confirm('Are you sure you want to delist this supplier?'));">DELIST</a></td>
                  
                  <td><?php echo ucfirst($dataAttri['sup_name']);?></td>
                  <td><?php echo ucfirst($dataAttri['sup_address']); ?></td>
                  <td> <?php echo $dataAttri['TIN'];?></td>
                  <td><?php echo $dataAttri['bus_type'];?></td>
                  <td><?php echo $dataAttri['tax_type'];?></td>
                  <td><?php echo ucfirst($dataAttri['contact_person']);?></td>
                  <td><?php echo $dataAttri['contact_no'];?></td>
                  <td align="right"><?php echo $dataAttri['discount'];	?>%</td>
                  <td><?php echo ($dataAttri['active'] == 1) ?"Yes":"No" ;?></td>
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
