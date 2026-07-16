<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';

  if(Input::get('barcode_name')){
?>
  <img alt="TESTING" src="/akempco/includes/barcode.php?codetype=Code39&size=100&text=<?php echo "0" .Input::get('barcode_name') . "000" . date("Y/m/d") . "0"  ?>" />
<?php 
  }
?>
                    
