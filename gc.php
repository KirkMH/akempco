<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/metaHeader.php';
  $table = 'tbl_productprice';
  $filter = 'prod_no';
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 
<?php
//loop and print every gift certificate
  if(Input::get('barcode_name')){
?>
  <img alt="TESTING" src="/akempco/includes/barcode.php?codetype=Code39&size=100&text=<?php echo "0" .Input::get('barcode_name') . "000" . date("Y/m/d") . "0"  ?>" />
<?php 
  }
?>
                    

       </div>
     </div>
   </section><!-- /.content -->
 </div><!-- /.content-wrapper -->

 <!-- =============================================== -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/includes/footer.php';
?>
