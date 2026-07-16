
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';
  $table = 'tbl_productprice';
  $filter = 'prod_no';
$uom_no =0;
 $prodname = "";

// $uomArray = array();
// if(Input::get('uom')){
//   foreach(Input::get('uom') as $uomkey=>$uomval) {
//     $uomArray[$uomkey] = $_GET['uom'][$uomkey];
//       // $int_ext = $_POST['int_ext'][$k];
//   } 
// }
  if(Token::check(Input::get('token'))){
    $dataAttri = $db->select('*', $table);
    $finfo = $dataAttri->fetch_fields();/* Get field information for all columns */
    $data = array();
    $sourceData = $_GET;//get all value of get

    foreach ($finfo as $valAttrib) {
      foreach ($sourceData  as $postedKey => $postedValue) {//get source
          if($valAttrib->name == $postedKey){//see if posted in get is in the db
            $data[$postedKey] = $postedValue;
          }
        // }
      }
    }
        

    if(Input::get('action') == 'insert') {//add
      // var_dump($data);
      if ($db->insert($table, array_map('strtolower', $data) )) {
        // Session::flash('processor_result', "Saved successfully."); 
        // $urlEncode = 'success=true?dataID=' . Input::get('$dataID');
        // var_dump($data);
        echo "<script>alert('saved!')</script>";
      } else {
        echo "<script>alert('Opps! There was an error in saving in the database.')</script>";
        // printf("Errormessage: %s\n", $db->error);
      }
    }
  }
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
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="GET">
          <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
            <div class="box-header with-border">
              <h3 class="box-title">Add New Unit of Measures</h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>                      
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <input name="action" value="<?php echo Input::get('dataID') ?  'insert' : ""; ?>"  type="hidden">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="dataID" value="<?php echo Input::get('dataID') ?  $_GET['dataID'] : ''; ?>"  type="hidden">
                  <input name="filter" value="<?php echo Input::get('dataID') ?  'dataID' : ''; ?>"  type="hidden">
                  <input name="table" value="<?php echo $table; ?>" type="hidden">
                  <input name="prod_no" value="<?php echo Input::get('dataID') ?>" type="hidden">

                  <?php
                    $sqlResult = $db->select_one('*', 'tbl_product', "WHERE {$filter}=" . Input::get('dataID'));
                    if($sqlResult){
                  ?>
                    <div class="form-group ">
                      <h3><?php echo ucfirst($sqlResult['prod_name']); ?></h3>
                    </div>
                  <?php
                    }
                  ?>

                  <div class="form-group">
                    <label for="">Unit of Measures</label>
                    <select class="form-control" name="uom_no">
                        <?php
// }
                          // $sqlResult2 = $db->select('*', "tbl_productprice", "WHERE prod_no=" . Input::get('prod_no') );
                          $sqlResult = $db->select('uom_no, uom_name', 'tbl_UOM', 'WHERE active=1');

                          while ($extractData = $sqlResult->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $extractData['uom_no']; ?>" > <?php echo $extractData['uom_name']; ?></option>
                            <?php
                            // echo "<input type='checkbox' name='uom[]' value='" .$extractData['uom_no'] . "' " ;
                            //  echo ">" . ucfirst($extractData['uom_name']) . " &nbsp; ";
                            // }
                          }
                        ?>
                    
                      <!-- <option >Select Status</option> -->
                      
                    </select>
                      <!-- </select>    -->
                  </div> 
                </div>


              </div>
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
            <h3 class="box-title">Product Unit of Measures</h3>
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
                  <th>Unit of Measure</th>
                  <th>Min Stock</th>
                  <th>Max Stock</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                // $sqlResult = $db->select('*', "tbl_productprice AS PR",  "INNER JOIN tbl_UOM AS UO ON PR.uom_no = UO.uom_no WHERE PR.prod_no=" . Input::get('prod_no'));

$sqlResult = $db->select('*', "tbl_productprice",  "WHERE prod_no=" . Input::get('dataID'));
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                ?>
                  <tr>
                    <td> <a href="/akempco/includes/processor.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&<?php echo $filter; ?>&dataID=<?php echo $dataAttri['prod_no']; ?> ">UPDATE</a> | 
                    <a href="/akempco/includes/processor.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&<?php echo $filter; ?>&dataID=<?php echo $dataAttri['prod_no']; ?>&active=0">DELIST</a></td>
            
                  
                     <td><?php echo $dataAttri['uom_no'];?></td>
                     <td><?php echo $dataAttri['min_stock'];?></td>
                     <td><?php echo $dataAttri['max_stock'];?></td>
                     <td><?php echo ($dataAttri['active'] == 1) ?"Yes":"No" ;?></td>
                   </tr>
                  <?php
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