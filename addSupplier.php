
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_productsupplier';
  $filter = 'ps_no';
  
  // $url = 'regProductPackage.php?filter=pk_no&dataID='.Input::get('dataID') . Input::get('action') == "delete" ? '&action=select' : '';
// $uomArray = array();
// if(Input::get('uom')){
//   foreach(Input::get('uom') as $uomkey=>$uomval) {
//     $uomArray[$uomkey] = $_GET['uom'][$uomkey];
//       // $int_ext = $_POST['int_ext'][$k];
//   } 
// }
  // if(Token::check(Input::get('token'))){
http://127.0.0.1/akempco/regProductPackage.php?page=regProductPackage.php&action=insert&dataID=1&filter=pk_no&table=tbl_productpackage&pk_no=1&prod_no=38&qty=8&submit=Save  
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
      if ($db->insert($table, $data) ) {
        // Session::flash('processor_result', "Saved successfully."); 
        echo "<script>alert('saved!')</script>";
      } else {
        echo "<script>alert('Opps! There was an error in saving in the database.')</script>";
      }
    }else if (Input::get('delID')){
      if($db->delete($table, 'WHERE pp_no=' . Input::get('delID'))) {
        echo "<script>alert('saved!')</script>";       
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

        <!-- Default box -->
        <div class="box">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?action=insert" method="GET"> 
          <!-- <form action="/akempco/includes/processor.php?action=insert" method="GET"> -->
          <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
            <div class="box-header with-border">
              <h3 class="box-title">Assign Suppliers to Product</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
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
                  <input name="prod_no" value="<?php echo Input::get('dataID') ?>" type="hidden">

                  <!-- PRINT PACKAGE NAME HERE -->
                  <?php
                    $sqlResult = $db->select_one('*', 'tbl_product', 'WHERE prod_no='. Input::get('dataID') );
                    if($sqlResult){
                  ?>
                    <div class="form-group ">
                    <label for="">Product Name</label>
                      <h3 style="color:#DD4B39;margin-top:0"><?php echo $sqlResult['prod_name']; ?></h3>
                    </div>
                  <?php
                    }
                  ?>

                  <div class="form-group">
                    <label for="">Select Supplier</label>
                    <select required class="form-control" name="sup_no">
                    <option value="">Select Supplier</option>
                        <?php
                          $sqlResult = $db->select('*', 'tbl_supplier', 'WHERE active=1 ORDER BY sup_name');
                          while ($extractData = $sqlResult->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $extractData['sup_no']; ?>" > <?php echo $extractData['sup_name']; ?></option>
                            <?php
                          }
                        ?>
                    </select>
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
            <h3 class="box-title">Suppliers of this Product</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="listTable" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTIONS</th>
                  <th>Supplier Name</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                // $sqlResult = $db->select('*', "tbl_productprice AS PR",  "INNER JOIN tbl_UOM AS UO ON PR.uom_no = UO.uom_no WHERE PR.prod_no=" . Input::get('prod_no'));

// $sqlResult = $db->select('*', "tbl_productpackage AS PK",  "INNER JOIN tbl_productprice AS PP ON PK.prod_no = PP.prod_no WHERE pk_no=" . Input::get('dataID'));
                
// SELECT PK.pp_no, PK.pk_no,PK.pprice_no,PK.qty,PK.ucost FROM tbl_productpackage AS PK 
// INNER JOIN tbl_productprice AS PP 
//   ON PK.prod_no = PP.prod_no 
// WHERE pk_no=1
                //filter is pk_no
                $sqlResult = $db->select('*',$table ,"INNER JOIN tbl_supplier ON tbl_supplier.sup_no = tbl_productsupplier.sup_no WHERE prod_no=" . Input::get('dataID'));
                
                if($sqlResult){
                  while ($dataAttri = $sqlResult->fetch_assoc()) {
                    $delID = $dataAttri['ps_no'];
                  ?>
                    <tr>
                      <td>             
                      <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?filter=ps_no&dataID=<?php echo Input::get('dataID')?>&delID=<?php echo $delID; ?>">Remove</a></td> 
                      <td><?php echo $dataAttri['sup_name'];?></td>
                     </tr>
                    <?php
                     }
                }

                  ?>
               </tbody>
             </table>
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