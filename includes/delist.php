<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
$audit = new Audit();
	$page = $db->escape(Input::get('page'));
	$table = $db->escape(Input::get('table'));
	$filter = $db->escape(Input::get('filter'));
	$dataID = $db->escape(Input::get('dataID'));
	$newData = "";
	// $urlEncode  = "";

	$dataAttri = $db->select('*', $table);
	$finfo = $dataAttri->fetch_fields();/* Get field information for all columns in database*/
	$data = array();
	$data2 = array();
	$sourceData = $_GET;//$_GET all value
	$sourceData2;

	foreach ($finfo as $valAttrib) {
    	foreach ($sourceData  as $postedKey => $postedValue) {//get source
        		if($valAttrib->name == $postedKey){//see if posted in get is in the db
        			$data[$postedKey] = $postedValue;
        			echo $postedKey . " | " .$postedValue . "<br>";
        			$newData .= $postedKey . ' = ' .  $postedValue . ', ';
        		}
    	}
    }

	if(Input::get('action') == "update"){//update

		if ($db->update($table, $data , "WHERE {$filter} = '$dataID'")) {
			$msg = "Delisted successfully.";
			$audit->record($_SESSION['login_member_no'], Input::get('action'), $table, $newData, date('Y-m-d'), date('H:i:s'));
		} else {
			$msg = "Opps. Sorry there was an error saving in the database.\nCode: UPDATE $table ($newData) WHERE {$filter} = '$dataID'";
		}
	}
	
	//if (isset($msg))
		Session::flash('msg', $msg);
	if (isset($err))
		Session::flash('err', $err);
	Redirect::to("/akempco/{$page}" );
?>