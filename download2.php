<?php


$link = "";
	/***** EDIT BELOW LINES *****/
	$DB_Server = "localhost"; // MySQL Server
	$DB_Username = "root"; // MySQL Username
	$DB_Password = ""; // MySQL Password
	$DB_DBName = "akempcodb"; // MySQL Database Name
	$DB_TBLName = "tbl_product"; // MySQL Table Name

if ($_GET["what"] == "prodlist") {
	$xls_filename = 'products_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
	$link = "purchases.php";
    
	 
	/***** DO NOT EDIT BELOW LINES *****/
	// Create MySQL connection
	$sql = "Select prod_no AS 'Prod.No.', barcode, prod_name AS 'Prod. Name' from $DB_TBLName ORDER BY prod_name";
	$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());
	// Select database
	$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());
	// Execute query
	$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());
	 
	// Header info settings
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=$xls_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	 
	/***** Start of Formatting for Excel *****/
	// Define separator (defines columns in excel &amp; tabs in word)
	$sep = ", "; // tabbed character
	 
	// Start of printing column names as names of MySQL fields
	for ($i = 0; $i<mysql_num_fields($result); $i++) {
	  echo mysql_field_name($result, $i) . ", ";
	}
	echo "Rcd Qty";

	print("\n");
	// End of printing column names
	 
	// Start while loop to get data
	while($row = mysql_fetch_row($result))
	{
	  $schema_insert = "";
	  for($j=0; $j<mysql_num_fields($result); $j++)
	  {
	    if(!isset($row[$j])) {
	      $schema_insert .= "NULL".$sep;
	    }
	    elseif ($row[$j] != "") {
	      $schema_insert .= "$row[$j]".$sep;
	    }
	    else {
	      $schema_insert .= "".$sep;
	    }
	  }
	  $schema_insert = str_replace($sep."$", "", $schema_insert);
	  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	  $schema_insert .= ",, ";
	  print(trim($schema_insert));
	  print "\n";
	}

}

else if ($_GET["what"] == "g_payment") {
	$xls_filename = 'grouppayment_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
	$link = "creditPayment.php";
    
	 
	/***** DO NOT EDIT BELOW LINES *****/
	// Create MySQL connection
	$sql = "Select group_no AS 'Group. No.', group_name AS 'Group Name', department AS 'Department' from tbl_groupcredit ORDER BY group_name";
	$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());
	// Select database
	$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());
	// Execute query
	$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());
	 
	// Header info settings
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=$xls_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	 
	/***** Start of Formatting for Excel *****/
	// Define separator (defines columns in excel &amp; tabs in word)
	$sep = ", "; // tabbed character
	 
	// Start of printing column names as names of MySQL fields
	echo "Group Credit Payment\n";
	for ($i = 0; $i<mysql_num_fields($result); $i++) {
	  echo mysql_field_name($result, $i) . ", ";
	}
	echo "Amount Paid, Date Paid";

	print("\n");
	// End of printing column names
	 
	// Start while loop to get data
	while($row = mysql_fetch_row($result))
	{
	  $schema_insert = "";
	  for($j=0; $j<mysql_num_fields($result); $j++)
	  {
	    if(!isset($row[$j])) {
	      $schema_insert .= "NULL".$sep;
	    }
	    elseif ($row[$j] != "") {
	      $schema_insert .= "$row[$j]".$sep;
	    }
	    else {
	      $schema_insert .= "".$sep;
	    }
	  }
	  $schema_insert = str_replace($sep."$", "", $schema_insert);
	  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	  $schema_insert .= ",,, ";
	  print(trim($schema_insert));
	  print "\n";
	}

}

else if ($_GET["what"] == "m_payment") {
	$xls_filename = 'memberpayment_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
	$link = "creditPayment.php";
    
	 
	/***** DO NOT EDIT BELOW LINES *****/
	// Create MySQL connection
	$sql = "Select member_no AS 'Member No.', member_name AS 'Member Name', barcode AS 'ID Number' from tbl_members ORDER BY member_name";
	$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());
	// Select database
	$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());
	// Execute query
	$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());
	 
	// Header info settings
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=$xls_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	 
	/***** Start of Formatting for Excel *****/
	// Define separator (defines columns in excel &amp; tabs in word)
	$sep = ", "; // tabbed character
	 
	// Start of printing column names as names of MySQL fields
	echo "Member Payment\n";
	for ($i = 0; $i<mysql_num_fields($result); $i++) {
	  echo mysql_field_name($result, $i) . ", ";
	}
	echo "Amount Paid, Date Paid";

	print("\n");
	// End of printing column names
	 
	// Start while loop to get data
	while($row = mysql_fetch_row($result))
	{
	  $schema_insert = "";
	  for($j=0; $j<mysql_num_fields($result); $j++)
	  {
	    if(!isset($row[$j])) {
	      $schema_insert .= "NULL".$sep;
	    }
	    elseif ($row[$j] != "") {
	    	if ($j == 1)
	      		$schema_insert .= '="'.$row[$j].'"'.$sep;
	      	else
	      		$schema_insert .= "$row[$j]".$sep;
	    }
	    else {
	      $schema_insert .= "".$sep;
	    }
	  }
	  $schema_insert = str_replace($sep."$", "", $schema_insert);
	  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	  $schema_insert .= ",,, ";
	  print(trim($schema_insert));
	  print "\n";
	}

}

else if ($_GET["what"] == "invcount") {
	$xls_filename = 'inventory_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
	$link = "inventory-count.php";
    
	 
	/***** DO NOT EDIT BELOW LINES *****/
	// Create MySQL connection
	$sql = "Select prod_no AS 'Prod.No.', barcode, prod_name AS 'Prod. Name' from $DB_TBLName ORDER BY prod_name";
	$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());
	// Select database
	$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());
	// Execute query
	$result = @mysql_query($sql,$Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());
	 
	// Header info settings
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=$xls_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	 
	/***** Start of Formatting for Excel *****/
	// Define separator (defines columns in excel &amp; tabs in word)
	$sep = ", "; // tabbed character
	 
	// Start of printing column names as names of MySQL fields
	for ($i = 0; $i<mysql_num_fields($result); $i++) {
	  echo mysql_field_name($result, $i) . ", ";
	}
	echo "Actual Count";

	print("\n");
	// End of printing column names
	 
	// Start while loop to get data
	while($row = mysql_fetch_row($result))
	{
	  $schema_insert = "";
	  for($j=0; $j<mysql_num_fields($result); $j++)
	  {
	    if(!isset($row[$j])) {
	      $schema_insert .= "NULL".$sep;
	    }
	    elseif ($row[$j] != "") {
	      $schema_insert .= "$row[$j]".$sep;
	    }
	    else {
	      $schema_insert .= "".$sep;
	    }
	  }
	  $schema_insert = str_replace($sep."$", "", $schema_insert);
	  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	  $schema_insert .= ",, ";
	  print(trim($schema_insert));
	  print "\n";
	}

}
?>
