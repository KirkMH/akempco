  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';

  $table = 'tbl_bo';
  $filter = 'bo_no';

  if (isset($_GET['submit'])) {
    $ex1 = $db->select_one('qty_begin', 'tbl_product', "WHERE barcode = " . $_GET['barcode']);

    if ($ex1 !== null) {

      $data2 = array(
        "qty_begin" => $ex1['qty_begin']-$_GET['quantity']
        );
      //echo $ex1['qty_onhand']-$_GET['quantity'];
      $db->update('tbl_product', $data2, 'WHERE barcode = '.$_GET['barcode']);
      $param = "";
      // foreach ($_GET as $key => $value) {
      //   $param = $param.$key."=".$value."&";
      // }
      $param = "page=BO.php&action=insert&table=tbl_bo&filter=barcode&dataID=". $_GET["barcode"] . "&quantity=" . $_GET["quantity"] . "&barcode=". $_GET['barcode'] ."&remarks=". $_GET['remarks'] . "&date=". date('Y-m-d H:i:s') . "&page=BO.php";   
      // echo "/akempco/includes/processor.php?".$param;
      header("Location: /akempco/includes/processor.php?".$param);
    }
    else {
      echo "<script language='javascript'>alert('Barcode was not found.');</script>";
    }
  }

  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

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
            <form action="BO.php" method="GET">
              <div class="box-header with-border">
                <h3 class="box-title"> <?php echo isset($_GET['bo_no']) ?  "Update Bad Order" : "Add New Bad Order"; ?></h3>
                <div class="box-tools pull-right">
                  <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                </div>
              </div>

              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                    <input name="action" value="<?php echo isset($_GET['bo_no']) ?  'update' : 'insert'; ?>"  type="hidden">
                    <input name="table" value="tbl_bo" type="hidden">
                    <input name="filter" value="barcode"  type="hidden">

                    <div class="form-group ">
                      <label>Barcode</label>
                      <input required value="<?php echo isset($_GET['barcode']) ?  $_GET['barcode'] : ''; ?>"  name="barcode"  type="text" class="form-control" id="" placeholder="">
                    </div>
                    <div class="form-group ">
                      <label>Quantity</label>
                      <input required value="<?php echo isset($_GET['quantity']) ?  $_GET['quantity'] : ''; ?>"  name="quantity" type="text" class="form-control" id="" placeholder="">
                    </div>
                    <div class="form-group ">
                      <label>Reason for Bad Order</label>
                      <input required value="<?php echo isset($_GET['remarks']) ?  $_GET['remarks'] : ''; ?>"  name="remarks" type="text" class="form-control" id="" placeholder="">
                    </div>
                    <input name="date" value="<?php echo date("M d Y"); ?>"  type="hidden">
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
              <h3 class="box-title">Bad Order Records</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>                  
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="" class="sorttable table table-bordered table-striped">
                <thead>
                  <tr>
                   <!-- <th>ACTIONS</th> -->
                   <th>Barcode</th>
                   <th>Product Name</th>
                   <th>Quantity</th>
                   <th>Remarks</th>
                   <th>Date</th>
                 </tr>
               </thead>
               <tbody>

                <?php 
                $sqlResult = $db->select('*', $table , "INNER JOIN tbl_product ON tbl_bo.barcode = tbl_product.barcode" );

                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  ?>
                  <tr>
                    <!--<td> <a href="/akempco/includes/processor.php?action=select&page=--><?php //echo basename($_SERVER['PHP_SELF']); ?><!--&table=--><?php //echo $table; ?><!--&filter=--><?php //echo $filter?><!--&dataID=--><?php //echo $dataAttri['bo_no']; ?> <!--">UPDATE</a></td>-->
                    <!--| <a href="/akempco/includes/processor.php?action=update&page=--><?php //echo basename($_SERVER['PHP_SELF']); ?><!--&table=--><?php //echo $table; ?><!--&filter=--><?php //echo $filter?><!--&dataID=--><?php //echo $dataAttri['bo_no']; ?><!--&active=">DELIST</a>-->

                    <td><?php echo $dataAttri['barcode'];?></td>
                    <td><?php echo $dataAttri['prod_name']; ?></td>
                    <td><?php echo $dataAttri['quantity']; ?></td>
                    <td><?php echo $dataAttri['remarks']; ?></td>
                    <td><?php echo date('Y-m-d ', strtotime($dataAttri['date'])); ?></td>
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

<!-- =============================================== -->


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
