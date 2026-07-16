<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
	$page = $db->escape(Input::get('page'));
	$table = $db->escape(Input::get('table'));
	$filter = $db->escape(Input::get('filter'));
	$dataID = $db->escape(Input::get('dataID'));
	$newData = "";
	$urlEncode  = "";

		if(Input::get('action') == "select"){
			$dataAttri = $db->select_one('*', $table, "WHERE {$filter} = '$dataID'");		
			if ($dataAttri) {
				foreach ($dataAttri as $key => $value) {
					$urlEncode .= $key . '=' . $value . "&";
				}
			}else{
				$msg = "Opps. Sorry there was an error saving in the database.";
				Session::flash('msg', $msg);
			}
		}
	
	// echo $urlEncode;
	Redirect::to("/akempco/{$page}?" . $urlEncode);
?>