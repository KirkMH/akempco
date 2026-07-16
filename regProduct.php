<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
  $table = 'tbl_product';
  $filter = 'prod_no';
  $sup_no =0;

  $validate = new Validate();
  if(Token::check(Input::get('token'))){
    $dataID = $db->escape(Input::get('dataID'));

        if(Input::get('action') == 'insert'){
          $validation = $validate->check($_GET, array(
            'barcode' => array(
              'tag_name' => 'Barcode', 
              'required' => true,
              'unique' => 'tbl_product'
              ),
            'prod_name' => array(
              'tag_name' => 'Product Name', 
              'required' => true,
              'unique' => 'tbl_product'
              ),
          ));

        }else if(Input::get('action') == 'update'){
          $validation = $validate->check($_GET, array(
            'barcode' => array(
              'tag_name' => 'Barcode', 
              'required' => true
              ),
            'prod_name' => array(
              'tag_name' => 'Product Name', 
              'required' => true
              )
            ));
        }

        if($validation->passed()){
            require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/processor.php';          
            
        }else{
          foreach ($validation->errors() as $errorKey => $errorVal) {
            Session::flash('err', $errorVal);
            break;
          }
        }
    /*}*/
  }
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/sidebar.php';

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
                  }else if(Session::exists('err')){
                  ?>
                    <div class="alert alert-danger alert-dismissable">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                      <h4>  <i class="icon fa fa-check"></i> <?php  echo Session::flash('err') ?></h4>
                    </div>
                  <?php 
                  }
                  ?>    

        <!-- Default box -->
        <div class="box">
          <form class="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . (Input::get('prod_no') ?  "?action=update" : "") ?>" method="GET" >        
          
          <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Input::get('prod_no') ?  "Update Product" : "Add New Product"; ?> </h3>
              <div class="box-tools pull-right">
                <!-- <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button> -->
              </div>                      
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <input name="action" value="<?php echo Input::get('prod_no') ?  'update' : 'insert'; ?>"  type="hidden">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="dataID" value="<?php echo Input::get('prod_no') ?  $_GET['prod_no'] : ''; ?>"  type="hidden">
                  <input name="filter" value="<?php echo Input::get('prod_no') ?  'prod_no' : ''; ?>"  type="hidden">
                  <input name="table" value="<?php echo $table; ?>" type="hidden">
                  <!-- <input name="table2" value="<?php echo $table2; ?>" type="hidden"> -->

                  <div class="form-group ">
                    <label>Barcode</label>
                    <input required value="<?php echo Input::get('barcode') ?  Input::get('barcode') : ''; ?>" name="barcode" type="text" class="form-control" id="" placeholder="">
                  </div>


                  <div class="form-group ">
                    <label>Product Name</label>
                    <input required value="<?php echo Input::get('prod_name') ?  Input::get('prod_name') : ''; ?>" name="prod_name" type="text" class="form-control" id="" placeholder="">
                  </div>


                  <div class="form-group ">
                    <label>Product Short Name</label>
                    <input required value="<?php echo Input::get('short_name') ?  Input::get('short_name') : ''; ?>"  name="short_name"  type="text" class="form-control" id="" placeholder="" maxlength="15">
                  </div>
                
<!--
                  <div class="form-group">
                    <label for="">Main Supplier (May add others from product list)</label>
                    <select required class="form-control" name="sup_no">
                      <option value="">Select Supplier</option>

                        <?php
                        /*
                          $sqlResult = $db->select('sup_no, sup_name', 'tbl_supplier', 'WHERE active=1 ORDER BY sup_name');

                          while ($extractData = $sqlResult->fetch_assoc()) {
                            echo "<option value=".$extractData['sup_no'];
                            if ($extractData['sup_no'] == $sup_no) echo " selected='selected'";
                            echo ">".$extractData['sup_name']."</option>";
                          }
                          */
                        ?>
                    </select>
                  </div>
-->


                </div>


                <div class="col-md-6">
                  

                  <div class="form-group ">
                    <label>Suggested Retail Price</label>
                    <input value="<?php echo Input::get('srpice') ?  Input::get('srprice') : '0'; ?>"  name="srprice"  type="number" step="0.01" class="form-control" id="" placeholder="" maxlength="15">
                  </div>

                  <div class="form-group ">
                    <label>Number of Items in Wholesale</label>
                    <input required value="<?php echo Input::get('numWholesale') ?  Input::get('numWholesale') : ''; ?>"  name="numWholesale"  type="number" step="1" class="form-control" id="" placeholder="" maxlength="15">
                  </div>

                  <div class="form-group">
                    <label for="">Status</label>
                    <select required class="form-control" name="active">
                      <option value="">Select Status</option>
                      <option <?php echo Input::get('active') ?  (Input::get('active') == '1' ? 'selected="selected"' : '') : '';?> value="1" >Active</option>
                      <option <?php echo Input::get('active') ?  (Input::get('active') == '0' ? 'selected="selected"' : '') : '';?> value="" >Inactive</option>
                    </select>
                  </div>

<!--                   <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input value="1" name="package" type="checkbox">
                          Package
                        </label>
                      </div>
                    </div> -->

                </div>


              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <p class="pull-left text-red"><b>All fields are required except Suggested Retail Price.</b></p>
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

<!-- /.box-body
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"> Upload CSV file</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div>

          <div class="box-body">
            <div class="col-lg-3">
              <div class="form-group">
                <select class="form-control">
                  <option selected="selected">Select Action</option>
                  <option>Add Products</option>
                  <option>Update Prices</option>
                  <option>Manual Inventory Count</option>
                  <option>Delist Products</option>
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
        </div> -->


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Registered Products</h3>
            <div class="box-tools pull-right">
              <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-group"><input type="button" onclick="location.href='delProduct.php'" value="View Delisted Products" /></div>
            <table id="listTable" class="sorttable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ACTIONS</th>
                  <th>Barcode</th>
                  <th>Product Name</th>
                  <th>Short Name</th>
                  <th>SRP</th>
                  <th>No of Items in Wholesale</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php

// SELECT PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name
// FROM `tbl_product` AS PR
// LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no
// LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no

                // $sqlResult = $db->select('PR.prod_no, PR.prod_name, PR.short_name, PP.min_stock, PP.max_stock, UO.uom_no, UO.uom_name, PR.active', 'tbl_product AS PR', 'LEFT JOIN tbl_productprice AS PP ON PR.prod_no = PP.prod_no LEFT JOIN tbl_UOM AS UO ON PP.uom_no = UO.uom_no');
             $sqlResult = $db->select('*', 'tbl_product', 'WHERE active=1 AND package=0 ORDER BY prod_name');
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['prod_no'];
                  ?>
                  <tr>
                    <td>                      
                      <a href="/akempco/regProductSupplier.php?action=select&page=regProductSupplier.php&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?> ">SUPPLIER</a> |
                      <a href="/akempco/includes/select.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?> ">UPDATE</a> |  
                      <a href="/akempco/includes/delist.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?>&active=0"  onclick="return (confirm('Are you sure you want to delist this product?'));">DELIST</a> | 
                      <a href="product-price.php?dataID=<?php echo $dataID; ?>&prodName=<?php echo $dataAttri['prod_name']; ?> ">PRICES</a>
                    </td>
            
                     <td><?php echo $dataAttri['barcode'];?></td>
                     <td><?php echo $dataAttri['prod_name'];?></td>
                     <td><?php echo $dataAttri['short_name'];?></td>
                     <td align="right"><?php echo $dataAttri['srprice'];?></td>
                     <td align="right"><?php echo $dataAttri['numWholesale'];?></td>
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