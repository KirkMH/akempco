
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
  $table = 'tbl_packages';
  $table2 = '';
  $filter = 'pk_no';

  $validate = new Validate();
  if(Token::check(Input::get('token'))){
    $dataID = $db->escape(Input::get('dataID'));

        if(Input::get('action') == 'insert'){
          $validation = $validate->check($_GET, array(
            'barcode' => array(
              'tag_name' => 'Barcode', 
              'required' => true,
              'unique' => 'tbl_package'
              ),
            'pk_name' => array(
              'tag_name' => 'Package Name', 
              'required' => true,
              'unique' => 'tbl_package'
              )
          ));

        }else if(Input::get('action') == 'update'){
          $validation = $validate->check($_GET, array(
            'barcode' => array(
              'tag_name' => 'Barcode', 
              'required' => true
              ),
            'pk_name' => array(
              'tag_name' => 'Package Name', 
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
        }
        ?>         

        <!-- Default box -->
        <div class="box">
          <form class="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . (Input::get('pk_no') ?  "?action=update" : "") ?>" method="GET" >        
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Input::get('pk_no') ?  "Update Package" : "Add New Package"; ?> </h3>
              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
              </div>                      
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <input name="action" value="<?php echo Input::get('pk_no') ?  'update' : 'insert'; ?>"  type="hidden">
                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                  <input name="dataID" value="<?php echo Input::get('pk_no') ?  $_GET['pk_no'] : ''; ?>"  type="hidden">
                  <input name="filter" value="<?php echo Input::get('pk_no') ?  'pk_no' : ''; ?>"  type="hidden">
                  <input name="table" value="<?php echo $table; ?>" type="hidden">
                  <input name="table2" value="<?php echo $table2; ?>" type="hidden">
                  <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />

                  <div class="form-group ">
                    <label>Bar Code</label>
                    <input required value="<?php echo Input::get('barcode'); ?>" name="barcode" type="text" class="form-control" id="" placeholder="">
                  </div>


                  <div class="form-group ">
                    <label>Package Name</label>
                    <input required value="<?php echo Input::get('pk_name'); ?>" name="pk_name" type="text" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group ">
                    <label>Short Package Name</label>
                    <input required value="<?php echo Input::get('spk_name'); ?>" name="spk_name" type="text" class="form-control" id="" placeholder="" maxlength="15">
                  </div>                  

                <div class="form-group ">
                  <label>Package Price</label>
                  <input required value="<?php echo Input::get('pk_price'); ?>"  name="pk_price"  type="number" step="0.01" class="form-control" id="" placeholder="">
                </div>   

              <div class="form-group">
                <label for="">Status <?php echo Input::get('active'); ?></label>
                <select required class="form-control" name="active">
                  <option <?php echo Input::get('active') ?  (Input::get('active') == 1 ? 'selected="selected"' : '') : '';?> value="1" >Active</option>
                  <option <?php echo Input::get('active') ?  (Input::get('active') == 0 ? 'selected="selected"' : '') : '';?> value="0" >Inactive</option>
                </select>
              </div>
               
              </div>

            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <p class="pull-left text-red"><b>All fields are Required</b></p>
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
          <h3 class="box-title">Registered Packages</h3>
          <div class="box-tools pull-right">
            <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="listTable" class="sorttable table table-bordered table-striped">
            <thead>
              <tr>
                <th>ACTIONS</th>
                <th>Package Name</th>
                <th>Package Price</th>
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
              $sqlResult = $db->select('*', $table);
              if($sqlResult){
                while ($dataAttri = $sqlResult->fetch_assoc()) {
                  $dataID = $dataAttri['pk_no'];
                  ?>
                  <tr>
                    <td> 
                      <a href="/akempco/regProductPackage.php?action=select&page=regProductPackage.php&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?> ">Included Products</a> | 
                      <a href="/akempco/includes/select.php?action=select&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?> ">UPDATE</a> |  
                      <a href="/akempco/includes/delist.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter; ?>&dataID=<?php echo $dataID; ?>&active=0"  onclick="return (confirm('Are you sure you want to delist this package?'));">DELIST</a>
                    </td>
                    
                    <td><?php echo $dataAttri['pk_name'];?></td>
                    <td align="right"><?php echo number_format($dataAttri['pk_price'], 2, ".", ",");?></td>
                    <td align="center"><?php echo ($dataAttri['active'] == 1 ? "Yes" : "No");?></td>
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