<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';

$link = "";
	/***** EDIT BELOW LINES *****/
	// $DB_Server = "192.168.254.20"; // MySQL Server
	// $DB_Username = "root"; // MySQL Username
	// $DB_Password = 'p@$$dB'; // MySQL Password
	// $DB_DBName = "akempcodb"; // MySQL Database Name
	// $DB_TBLName = "tbl_product"; // MySQL Table Name

	// $Connect = @mysqli_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />");// . mysqli_error($Connect) . "<br />" . mysqli_errno($Connect));


if ($_GET["what"] == "prodlist") {
	$xls_filename = 'products_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
	$link = "purchases.php";
    
	// get supplier name
	$ex1 = $db->select_one('sup_name', 'tbl_supplier', "WHERE sup_no=".$_GET["sup_no"]);
	$ex2 = $db->select("prod_no AS 'Prod.No.', barcode, prod_name AS 'Prod. Name'", 'tbl_product', "WHERE prod_no IN (SELECT prod_no FROM tbl_productsupplier WHERE sup_no=".$_GET["sup_no"].") AND active = 1 ORDER BY prod_name");

	// Header info settings
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$xls_filename);

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	fputcsv($output, array($_GET["sup_no"], $ex1['sup_name']));

	// Start of printing column names as names of MySQL fields
	$cols = array();
	$cols[0] = "Prod. No.";
	$cols[1] = "Barcode";
	$cols[2] = "Prod. Name";
	$cols[3] = "Received Quantity";
	$cols[4] = "Supplier Price";
	$cols[5] = "Retail Price";
	$cols[6] = "Wholesale Price";

	// output the column headings
	fputcsv($output, $cols);

	// End of printing column names
	 
	// Start while loop to get data
	while ($ex = $ex2->fetch_assoc()){
		fputcsv($output, $ex);
	}
}else if ($_GET["what"] == "g_payment") {
	$xls_filename = 'grouppayment_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
	$link = "creditPayment.php";

	// get supplier name
	$ex2 = $db->select("group_no AS 'Group. No.', group_name AS 'Group Name', charge_total", 'tbl_groupcredit', "ORDER BY group_name");

	// Header info settings
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$xls_filename);

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// Start of printing column names as names of MySQL fields
	$cols = array();
	$cols[0] = "Group No.";
	$cols[1] = "Group Name";
	$cols[2] = "Collectible";
	$cols[3] = "Amount Paid";
	$cols[4] = "Date Paid";
	$cols[5] = "Reference";

	// output the column headings
	fputcsv($output, array("Group Credit Payment"));
	fputcsv($output, $cols);
	 
	// Start while loop to get data
	while ($ex = $ex2->fetch_assoc()) {
		fputcsv($output, $ex);
	}	 
}

else if ($_GET["what"] == "m_payment") {
	$xls_filename = 'memberpayment_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
	$link = "creditPayment.php";
    
	// get supplier name
	$ex2 = $db->select("member_no AS 'Member No.', member_name AS 'Member Name', charge_total", 'tbl_members', "ORDER BY member_name");

	// Header info settings
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$xls_filename);

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// Start of printing column names as names of MySQL fields
	$cols = array();
	$cols[0] = "Member No.";
	$cols[1] = "Member Name";
	$cols[2] = "Collectible";
	$cols[3] = "Amount Paid";
	$cols[4] = "Date Paid";
	$cols[5] = "Reference";

	// output the column headings
	fputcsv($output, array("Member Payment"));
	fputcsv($output, $cols);
	 
	// Start while loop to get data
	while ($ex = $ex2->fetch_assoc()) {
		fputcsv($output, $ex);
	}	 

}

else if ($_GET["what"] == "invcount") {
	$xls_filename = 'inventory_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
	$link = "inventory-count.php";

    
	// get supplier name
	$ex2 = $db->select("prod_no AS 'Prod.No.', barcode, prod_name AS 'Prod. Name'", 'tbl_product', "WHERE active=1 AND package=0 ORDER BY prod_name");

	// Header info settings
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$xls_filename);

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// Start of printing column names as names of MySQL fields
	$cols = array();
	$cols[0] = "Prod. No.";
	$cols[1] = "Barcode";
	$cols[2] = "Product Name";
	$cols[3] = "Actual Count";

	// output the column headings
	fputcsv($output, $cols);
	 
	// Start while loop to get data
	while ($ex = $ex2->fetch_assoc()) {
		fputcsv($output, $ex);
	}	 
}




else if ($_GET["what"] == "salesReport" || $_GET["what"] == "inventoryReport") {
	$xls_filename = $_GET["what"].'_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
	
	// // Header info settings
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$xls_filename);

	// // create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	$cols = array();
	if (!isset($_SESSION)) {
		session_start();
	}
	$cols = $_SESSION['exported'];

	// Start while loop to get data
	$i = 0;
	for ($i = 0; $i < count($cols); $i=$i+1){
		if ($i < 1) {
			$str = array();
			$str[0] = $cols[$i];
		}
		else {
			$str = $cols[$i];
		}
		fputcsv($output, $str);
	}	
}

else if ($_GET["what"] == "inventoryCount") {
	$xls_filename = 'inventoryCount_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name

	$addFilter = "";
	if (isset($_GET['which'])) {
		$addFilter = " AND prod_no IN (".$_GET['which'].")";
	}
    
	// get supplier name
	$ex2 = $db->select('prod_name, short_name, (SELECT SUM(qty_onhand) AS onhand FROM tbl_purchasedetail WHERE qty_onhand > 0 AND prod_no=tbl_product.prod_no) AS on_hand, actual_count, variance', 'tbl_product', 'WHERE active=1 AND package = 0 '.$addFilter);

	// Header info settings
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$xls_filename);

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// Start of printing column names as names of MySQL fields

	$cols = array();

	$cols[0] = "Product Name";
	$cols[1] = "Short Name";
	$cols[2] = "System Inventory";
	$cols[3] = "Actual Count";
	$cols[4] = "Variance";

	// output the column headings
	fputcsv($output, $cols);
	 
	// Start while loop to get data
	while ($ex = $ex2->fetch_assoc()) {
		fputcsv($output, $ex);
	}	 

}

else if ($_GET["what"] == "acctRcv") {
	$xls_filename = 'AccountReceivableReport_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name\
    

	  $type = "m";
	  if (Input::get('ar_type') == "g") {
	  	$type = "g";
	  }
	  
	  $cname = ($type == "m" ? "member_name" : "group_name");
	  $ccred = ($type == "m" ? "(credit_limit + extra_credit)" : "credit_limit");
	  $ctble = ($type == "m" ? "tbl_members" : "tbl_groupcredit");


	// get supplier name
	$ex2 = $db->select("$cname, $ccred AS climit, charge_total", $ctble, "WHERE active = 1 ORDER BY $cname");

	// Header info settings
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$xls_filename);

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// Start of printing column names as names of MySQL fields
	$cols = array();
	$cols[0] = ($type == "m" ? "Member Name" : "Group Name");
	$cols[1] = "Total Credit Limit";
	$cols[2] = "Total Charged / Receivables";

	// output the column headings
	$title = ($type == "m" ? "Member's" : "Group Credit's") . "Inventory Report";
	fputcsv($output, array($title));
	fputcsv($output, $cols);
	 
	// Start while loop to get data
	while ($ex = $ex2->fetch_assoc()) {
		fputcsv($output, $ex);
	}	 
}
?>
