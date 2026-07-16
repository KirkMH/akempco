<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
$table = "tbl_giftcert";
$filter = 'gc_no';

  $validate = new Validate();
  if(Token::check(Input::get('token'))){
    $dataID = $db->escape(Input::get('dataID'));

        if(Input::get('action') == 'insert'){
          $validation = $validate->check($_GET, array(
            'barcode' => array(
              'tag_name' => 'Barcode', 
              'required' => true,
              'unique' => 'tbl_giftcert'
              )
          ));

        }else if(Input::get('action') == 'update'){
          $validation = $validate->check($_GET, array(
            'barcode' => array(
              'tag_name' => 'Barcode', 
              'required' => true
              )
            ));
        }

        if($validation->passed()){
            require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/processor.php';
            // Redirect::to('/akempco/includes/processor.php');
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
$data = array();
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
<form class="regForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) .  (Input::get('gc_no') ?  "?action=update" : ""); ?>" method="GET" >
                <form action="/akempco/includes/processor.php?<?php echo Input::get('dept_no') ?  "action=update" : "" ?>" method="GET">
                <input class="button orange" type='hidden' name='token' value="<?php echo $token; ?>" />
                    <div class="box-header with-border">
                      <h3 class="box-title"> Register New Gift Certificate</h3>
                      <div class="box-tools pull-right">
                        <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                      </div>                      
                    </div>
                    <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                  <input name="page" value="<?php echo basename($_SERVER['PHP_SELF']) ?>"  type="hidden">
                                  <input name="action" value="<?php echo Input::get('gc_no') ?  'update' : 'insert'; ?>"  type="hidden">
                                  <input name="dataID" value="<?php echo Input::get('gc_no') ?  $_GET['gc_no'] : ''; ?>"  type="hidden">
                                  <input name="filter" value="<?php echo Input::get('gc_no') ?  'gc_no' : ''; ?>"  type="hidden">
                                  <input name="table" value="<?php echo $table; ?>" type="hidden">


                                  <div class="form-group ">
                                    <label>Barcode / Control Number</label>
                                    <input required type="text" class="form-control" name="barcode" id="" placeholder="">
                                  </div>

                                  
                                  <div class="form-group ">
                                    <label>Amount</label>
                                    <input required type="text" class="form-control" name="amount" id="" placeholder="">
                                  </div>

                                  
                                <!--   <div class="form-group ">
                                    <label>Source</label>
                                    <input required type="text" class="form-control" name="source" id="" placeholder="">
                                  </div> -->

                                  <input name="regDate" value="<?php echo date('Y-m-d'); ?>"  type="hidden">
                                  
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group ">
                                    <label>Expiry Date</label>
                                    <input required type="text" class="form-control datepicker" name="expiryDate" id="" value="" placeholder="">
                                  </div>                                      
                                </div>
                            </div>
                    </div>
                    <div class="box-footer">
                        <p class="pull-left text-red"><b>All fields are required</b></p>
                        <div class="form-group pull-right">
                          <div class="col-lg-5 input-group">
                              <span class="input-group-btn">
                                <button class="btn btn-info" name="submit" type="submit" value="Save">Save</button>
                              </span>
                          </div>
                        </div>   
                    </div>
                </form>
              </div>
              

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Registered Gift Certificate</h3>
                  <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                  </div>                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="sorttable table table-bordered table-striped">
                    <thead>
                      <tr>.
                        <th>Action</th>
                        <th>Barcode</th>
                        <th>Date Registered</th>
                        <th>Date Expire</th>
                        <th>Amount</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sqlResult = $db->select('*', $table , 'WHERE ORDER BY gc_no ASC');  
                      if($sqlResult){
                        while ($dataAttri = $sqlResult->fetch_assoc()) {
                          $dataID = $dataAttri['gc_no'];
                          ?>
                          <tr>
                            <td><a href="/akempco/includes/delist.php?action=update&page=<?php echo basename($_SERVER['PHP_SELF']); ?>&table=<?php echo $table; ?>&filter=<?php echo $filter?>&dataID=<?php echo $dataAttri['gc_no']; ?>&active=0" onclick="return (confirm('Are you sure you want to delist this group credit?'));">DELIST Gift Certificate</a></td>
                            <td><?php echo $dataAttri['barcode'];?></td>
                            <td><?php echo date("m/d/Y", strtotime($dataAttri['regDate'])) ;?></td>
                            <td><?php echo $dataAttri['expiryDate'];?></td>
                            <td><?php echo $dataAttri['amount'];?></td>
                            <td><?php echo ($dataAttri['returned'] == 1) ? "Used" : "Out";?></td>                     
                         </tr>
                         <?php
                       }
                     }
                     ?>
                     <tbody>
                     </table>
                   </div><!-- /.box-body -->
                 </div><!-- /.box -->
               </div>
             </div>
           </section>
         </div>
         <!-- =============================================== -->
         <?php
         require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
         ?>
