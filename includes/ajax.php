<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';

if($_GET['type'] == 'country'){
	$sqlResult = $db->select("*", $table, "WHERE barcode LIKE '". $_GET['barcode'])"%'");	
	$data = array();
	while ($row = mysql_fetch_array($result)) {
		array_push($data, $row['name']);	
	}

    if($sqlResult){
      	while ($dataAttri = $sqlResult->fetch_assoc()) {
        	$data = $dataAttri['sup_no'];

        }
		foreach ($sourceData  as $postedKey => $postedValue) {//get source
	    		if($valAttrib->name == $postedKey){//see if posted in get is in the db
	    			$data[$postedKey] = $postedValue;
	    		}
		}

    }


	echo json_encode($data);
}

?>