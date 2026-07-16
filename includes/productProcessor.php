<?php

// print_r($_GET);


// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);    
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';


$urlEncode = "";
$sup_no = "";
$ps_no = "";
$page = $db->escape(Input::get('page'));
$table = $db->escape(Input::get('table'));
$table2 = $db->escape(Input::get('table2'));
$filter = $db->escape(Input::get('filter'));
$dataID = $db->escape(Input::get('dataID'));
$sup_no = "&sup_no=".$db->escape(Input::get('sup_no'));
$ps_no = "&ps_no=".$db->escape(Input::get('ps_no'));

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
        	}
        }

		if(Input::get('action') == 'insert') {//add
			$res = "Record saved!";
			if ($db->insert($table, $data) ) {
				$res = "Record saved!";
				$prod_no = $db->lastInsertedId();
				if(Input::get('table2')){
					$data2 = array(
						"prod_no" => $prod_no,
						"sup_no" => Input::get('sup_no')
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
			if ($db->update($table, $data , "WHERE {$filter} = '$dataID'")) {
				$urlEncode = 'success=true';
				if(Input::get('table2')){
					$data2 = array(
						"sup_no" => Input::get('sup_no')
						);
					if($db->update($table2, $data2 , "WHERE ps_no=" . Input::get('ps_no'))){
						$res = "Record saved 2!";
						echo "<script>alert('{$res}')</script>";
					}			
				}	
				echo "<script>alert('Done update!')</script>";
			} else {
				printf("Errormessage: %s\n", $db->error);
			}
		} 
	}
	Redirect::to("/akempco/{$page}?" . $urlEncode . $sup_no . $ps_no);

	// $dataAttri->free();
	// $db->close();
?>

