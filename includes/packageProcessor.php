<?php

// print_r($_GET);


// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);    
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';


$urlEncode = "";

$page = $db->escape(Input::get('page'));
$table = $db->escape(Input::get('table'));
$filter = $db->escape(Input::get('filter'));
$dataID = $db->escape(Input::get('dataID'));


	if(Input::get('action') == "select"){
		$dataAttri = $db->select_one('*', $table, "WHERE {$filter} = '$dataID'");		
		if ($dataAttri) {
			foreach ($dataAttri as $key => $value) {
				$urlEncode .= $key . '=' . $value . "&";
			}
		}else{
			printf("Errormessage: %s\n", $db->error);
		}
	}else{
		$dataAttri = $db->select('*', $table);
		$finfo = $dataAttri->fetch_fields();/* Get field information for all columns in database*/
		$data = array();
		$data2 = array();
		$sourceData = $_GET;//get all value of posted GET
		$sourceData2;

		foreach ($finfo as $valAttrib) {
        	foreach ($sourceData  as $postedKey => $postedValue) {//get source
	        		if($valAttrib->name == $postedKey){//see if posted in get is in the db
	        			$data[$postedKey] = $postedValue;
	        		}
	        		/*else if($valAttrib->name == $postedKey){
	        			$data2[$postedKey] = ucfirst($postedValue);
	        		}*/
        	}
        }
/*		if(Input::get('table2')){
			$dataAttri2 = $db->select('*', Input::get('table2'));
			$finfo2 = $dataAttri->fetch_fields(); //Get field information for all columns 
			

			foreach ($finfo2 as $valAttrib2) {
	        	foreach ($sourceData  as $postedKey2 => $postedValue2) {//get source
		        		if($valAttrib2->name == $postedKey2){//see if posted in get is in the db
		        			$data[$postedKey] = ucfirst($postedValue);
		        		}
	        	}
	        }				
		}*/
// echo "----------------------------------------";
		if(Input::get('action') == 'insert') {//add
			$res = "Record saved!";
			if ($db->insert($table, $data) ) {
				// Session::flash('processor_result', "Saved successfully."); 
				// $urlEncode = 'success=true';
				$res = "Record saved!";
				echo "<script>alert('{$res}')</script>";
				// $pk_no = $db->lastInsertedId();
				if(Input::get('table2')){
					$data2 = array(
						"barcode" => Input::get('barcode'),
						"prod_name" => Input::get('pk_name'),
						"short_name" => Input::get('spk_name'),
						"active"=> 1,
						"package" => 1
						);
					if($db->insert(Input::get('table2'), $data2) ){
						$res = "Record saved 2!";
						echo "<script>alert('{$res}')</script>";
					}
					
				}else{
					$res = "Opps. Sorry there was an error saving in the database.";
				}
				// echo "<script>alert('here na me')</script>";
			} else {
				$res = "Opps. Sorry there was an error saving in the database.";
			}
			echo "<script>alert('{$res}')</script>";
		}else if(Input::get('action') == "update"){//update
			var_dump($data);
			if ($db->update($table, $data , "WHERE {$filter} = '$dataID'")) {
				$urlEncode = 'success=true';
				echo "<script>alert('Done update!')</script>";
			} else {
				printf("Errormessage: %s\n", $db->error);
			}
		} 
	}
	Redirect::to("/akempco/{$page}?" . $urlEncode);

	// $dataAttri->free();
	// $db->close();
?>

