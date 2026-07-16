<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
if (isset($_POST['submit'])) {


$id = $_POST['pd_id'];
$p_id = $_POST['purchase_id'];
$r_qty = $_POST['rqty'];
$r_price = $_POST['rprice'];
$s_price = $_POST['sprice'];
$w_price = $_POST['wprice'];

 //$sqlResult = $db->update('tbl_purchasedetail', 'qty_delivered='$r_qty',retail_price='$r_price',wholesalae_price='$w_price',supplier_price='$s_price'' , "WHERE pd_id = '$id'");

$sqlResult = $db->query("Update tbl_purchasedetail SET qty_delivered='$r_qty',retail_price='$r_price',wholesale_price='$w_price',supplier_price='$s_price' WHERE pd_id = '$id'");
if ($sqlResult) {
				echo'
			<script>
				window.location.href="purchase-details.php?id='.$p_id.'";
			</script>
            
		';
			} else {
				printf("Errormessage: %s\n", $db->error);
				echo "<script>alert('Opps. Sorry there was an error updating in the database.')</script>";
			}

}
?>