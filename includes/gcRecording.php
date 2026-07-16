<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
$audit = new Audit();
$table = "tbl_giftcert";

  if(Input::get('generate') == 1){
    $qty = Input::get('qty');
    while ($qty > 0) {
      $qty--;      
      $data['barcode'] = "1" . date('Y-m-d') . "AUGUST12016" . date('H:i:s') . "00" . $qty;
      $data['amount'] = Input::get('amount');
      $data['genDate'] = date('Y-m-d H:i:s');
      $data['expiryDate'] = Input::get('expiryDate');

       $newData= "barcode='" . $data['barcode'] . "' , amount=" . $data['amount'] . ", genDate='" . $data['genDate'] . "', expiryDate='" . $data['expiryDate'] . "'" ;
// var_dump($data);
      if(!$db->insert($table, $data)){
        throw new Exception("There was a problem updating.");
      }
      Session::flash('msg', "Finish generating Gift Certificate");
      $audit->record($_SESSION['login_member_no'], "Insert", $table, $newData, date('Y-m-d'), date('H:i:s'));
    }
    Redirect::to('../regGiftCertificate.php');
  }

  ?>