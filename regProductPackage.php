
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_productpackage';
  $filter = 'pk_no';

  $total = 0;
  
  // $url = 'regProductPackage.php?filter=pk_no&dataID='.Input::get('dataID') . Input::get('action') == "delete" ? '&action=select' : '';
// $uomArray = array();
// if(Input::get('uom')){
//   foreach(Input::get('uom') as $uomkey=>$uomval) {
//     $uomArray[$uomkey] = $_GET['uom'][$uomkey];
//       // $int_ext = $_POST['int_ext'][$k];
//   } 
// }
  // if(Token::check(Input::get('token'))){
//http://127.0.0.1/akempco/regProductPackage.php?page=regProductPackage.php&action=insert&dataID=1&filter=pk_no&table=tbl_productpackage&pk_no=1&prod_no=38&qty=8&submit=Save  
    if(Input::get('action') == 'insert') {//add
      $dataAttri = $db->select('*', $table);
      $finfo = $dataAttri->fetch_fields();/* Get field information for all columns */
      $data = array();
      $sourceData = $_GET;//get all value of get      
      foreach ($finfo as $valAttrib) {
        foreach ($sourceData  as $postedKey => $postedValue) {//get source
            if($valAttrib->name == $postedKey){//see if posted in get is in the db
              $data[$postedKey] = $postedValue;
            }
        }
      }
      // var_dump($data);
    }else if (Input::get('delID')){
      if($db->delete($table, 'WHERE pp_no=' . Input::get('delID'))) {
        //echo "<script>alert('saved!')</script>";       
        // Redirect::to($url);
      }else{
        echo "<script>alert('Opps! There was an error in saving in the database.')</script>";
      }
    }
  // }
  $token = Token::generate();  
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
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?action=insert" method="GET"> 
          <!-- <form action="/akempco/includes/processor.php?action=insert" method="GET"> -->
            <div class="box-header with-border">
              <h3 class="box-title">Add New Product In Package</h3>
              <div class="box-tools pull-right">
                <h5><a href="regPackage.php">View List of Packages</a></h5>
              </div>                      
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="action" value="insert"  type="hidden">
                  <input name="dataID" value="<?php echo Input::get('dataID')?>"  type="hidden">
                  <input name="filter" value="pk_no"  type="hidden">
                  <input name="table" value="<?php echo $table; ?>" type="hidden">
                  <input name="pk_no" value="<?php echo Input::get('dataID') ?>" type="hidden">

                  <!-- PRINT PACKAGE NAME HERE -->
                  <?php
                    $sqlResult = $db->select_one('*', 'tbl_packages', 'WHERE pk_no='. Input::get('dataID') );
                    if($sqlResult){
                  ?>
                    <div class="form-group ">
                    <label for="">Package Name</label>
                      <h3 style="color:#DD4B39;margin-top:0"><?php echo $sqlResult['pk_name']; ?></h3>
                    </div>

                    <div class="form-group ">
                    <label for="">Package Price</label>
                      <h3 style="color:#DD4B39;margin-top:0"><?php echo $sqlResult['pk_price']; ?></h3>
                    </div>
                  <?php
                    }
                  ?>

                  <div class="form-group">
                    <label for="">Select Product</label>
                    <select required class="form-control" name="prod_no">
                    <option value="">Select Product</option>
                        <?php
                          $sqlResult = $db->select('*', 'tbl_product', 'WHERE active=1 AND package = 0 ORDER BY prod_name');
                          while ($extractData = $sqlResult->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $extractData['prod_no']; ?>" > <?php echo $extractData['prod_name']; ?></option>
                            <?php
                          }
                        ?>
                    </select>
                  </div>

                  <div class="form-group ">
                    <label>Quantity</label>
                    <input required value="" min="0" name="qty" type="text" class="form-control" id="" placeholder="">
                  </div>                  
                </div>
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <p class="pull-left text-red"><b>All fields are required</b></p>
              <div class="form-group pull-right">
                <div class="col-lg-5 input-group">
                  <span class="input-group-btn">
                    <button class="btn btn-info" name="submit" type="submit" value="Save">Add</button>
                  </span>
                </div><!-- /input-group -->
              </div><!-- /.form-group -->                 
            </div><!-- /.box-footer-->
          </form>
        </div><!-- /.box -->


        <div class="box">
          <div class="box-header">
            <h3 class="box-title"> Product Package Content</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">

            <table id="listTable" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTIONS</th>
                  <!-- <th>Barcode</th> -->
                  <!-- <th>Product Name</th>
                  <th>Short Name</th> -->
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Unit Cost</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sqlResult = $db->select('*',$table ,"INNER JOIN tbl_product ON tbl_productpackage.prod_no = tbl_product.prod_no WHERE {$filter}=" . Input::get('dataID'));
                echo "SELECT * FROM $table INNER JOIN tbl_product ON tbl_productpackage.prod_no = tbl_product.prod_no WHERE {$filter}=" . Input::get('dataID');
                if($sqlResult){
                  while ($dataAttri = $sqlResult->fetch_assoc()) {
                    $delID = $dataAttri['pp_no'];
                    $av_pr = 0;

                    $rRPrice = $db->select_one("AVG(retail_price) AS avgrprice", "tbl_purchasedetail", "WHERE prod_no=".$dataAttri['prod_no']." AND qty_onhand > 0");
                     if ($rRPrice) {
                        if ($rRPrice['avgrprice'] > 0) {
                          $av_pr = $rRPrice['avgrprice'];
                          $total = $total + ($rRPrice['avgrprice'] * $dataAttri['qty']) ;
                          if ((Input::get('action') == 'insert') && ($db->insert($table, $data))) {
                            echo "<script>alert('saved!')</script>";
                          } else {
                            echo "<script>alert('Opps! There was an error in saving in the database.')</script>";
                          }
                        }
                     }
                     if (!isset($av_pr) || (isset($av_pr) && $av_pr <= 0)) {
                      echo "<script>alert('Cannot find the price for this product. Please make sure that you have already uploaded your purchases for this product.')</script>";
                     }
                     else {
                  ?>
                      <tr>
                        <td><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?filter=pk_no&dataID=<?php echo Input::get('dataID')?>&delID=<?php echo $delID; ?>" onclick="return (confirm('Are you sure you want to remove the product from this package?'));">Remove</a></td> 
                        <td><?php echo $dataAttri['prod_name'];?></td>
                        <td align='center'><?php echo $dataAttri['qty'];?></td>
                        <td align='right'><?php echo number_format($av_pr, 2, ".", ",");?></td>
                      </tr>
                    <?php
                      }
                    }
                  }
                  ?>

               </tbody>
             </table>
             <div style="color:#FF5722"> <h4>Total Package Cost: <?php echo number_format($total, 2, ".", ","); ?></h4></div>
           </div><!-- /.box-body -->

          
         </div><!-- /.box -->              
       </div><!--/.col-md-12  -->
     </div><!-- /.row-->
   </section><!-- /.content -->

 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->
 
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>