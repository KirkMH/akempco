<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);    
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';

$page = $db->escape(Input::get('page'));
$table = $db->escape(Input::get('table'));
$counterData = 1;

if(Input::get('action') == "CSV"){// CSV
	if ($_FILES["uploadedfile"]["error"] > 0){
		$urlEncode =  "success=false?error: " . $_FILES["uploadedfile"]["error"] . "<br>";
	}else{
		$csv_file = $_FILES["uploadedfile"]["tmp_name"];
		if (($getfile = fopen($csv_file, "r")) !== false){

		$dataAttri = $db->select('*', $table);
		$finfo = $dataAttri->fetch_fields();/* Get field information for all columns */
		// var_dump($finfo);
		$data = array();
			
			while (!feof($getfile) ) {
				$lineData = fgetcsv($getfile, 1024);			

				foreach ($finfo as $valAttrib) {
		        	foreach ((array)$lineData  as $excelKey => $excelValue) {//get source
		        		print_r($valAttrib->name . " | " .$excelValue . "<br>");
		        		if($valAttrib->name == $excelValue){//see if posted in get is in the db
		        			$data[$excelKey] = $excelValue;
		        			// echo $postedKey;
		        		}
		        	}
		        }
		        // var_dump($data);
		        $counterData++;
			}					
		}
		// var_dump($sourceData);
		// if ($db->insert($table, $data)) {
		// 	$urlEncode = 'success=true';
		// } else {
		// 	printf("Errormessage: %s\n", $db->error);
		// }
	}
}

// Redirect::to("/akempco/{$page}?" . $urlEncode);
?>