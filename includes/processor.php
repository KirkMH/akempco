<?php
// session_start();
// print_r($_GET);


// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);    

// require_once $_SERVER['DOCUMENT_ROOT'] . '/akempco/core/init.php';
	$page = Input::get('page');
	$page = !empty($page) ? $db->escape($page) : 'index.php';
// if(Token::check(Input::get('token'))){
	$audit = new Audit();
	


	$table = $db->escape(Input::get('table'));
	$filter = $db->escape(Input::get('filter'));
	$dataID = $db->escape(Input::get('dataID'));
	$newData = "";

/*		if(Input::get('action') == "select"){
			$dataAttri = $db->select_one('*', $table, "WHERE {$filter} = '$dataID'");		
			if ($dataAttri) {
				foreach ($dataAttri as $key => $value) {
					$urlEncode .= $key . '=' . $value . "&";
				}
			}else{
				$msg = "Opps. Sorry there was an error saving in the database.";
			}
		}else{*/
			$dataAttri = $db->select('*', $table);
			$finfo = $dataAttri->fetch_fields();/* Get field information for all columns in database*/
			$data = array();
			$data2 = array();
			$sourceData = $_GET;//get all value of GET
			$sourceData2;

			foreach ($finfo as $valAttrib) {
	        	foreach ($sourceData  as $postedKey => $postedValue) {//get source
		        		if($valAttrib->name == $postedKey){//see if posted in get is in the db
		        			$data[$postedKey] = $postedValue;
		        			 $newData .= $postedKey . ' = ' .  $postedValue . ', ';
		        		}
	        	}
	        }
	        
	        // $newData =  implode(",", $data);
			if(Input::get('action') == 'insert') {
				if ($db->insert($table, $data) ) {
					// $urlEncode = 'success=true';
					$msg = "Record saved!";
					
					if(Input::get('table2')){
						$data2 = array("{$filter}" => $db->lastInsertedId());
						if($db->insert(Input::get('table2'), $data2) ){
							$msg = "Record saved!";
						}else{
							$msg = "Opps. Sorry there was an error saving in the database.";
						}
					}
				} else {
					$msg = "Opps. Sorry there was an error saving in the database.";
				}
			}else if(Input::get('action') == "update"){//update
				if ($db->update($table, $data , "WHERE {$filter} = '$dataID'")) {
					$msg = "Done Update.";
				} else {
					$msg = "Opps. Sorry there was an error saving in the database.";
				}
			}
			$audit->record($_SESSION['login_member_no'], Input::get('action'), $table, $newData, date('Y-m-d'), date('H:i:s'));
	/*	}*/

	// echo $_SESSION['login_member_no'], Input::get('action'), $table, $newData, date('Y-m-d'), date('H:i:s');
	 

	 // echo "<br><br>" . Session::flash('msg'); //displayer


	Session::flash('msg', $msg);
	// Redirect::to("/akempco/{$page}?" . $urlEncode);
// }else{
	if($page == "regProduct.php"){
Redirect::to("/akempco/regProductSupplier.php?action=select&page=regProductSupplier.php&table=tbl_product&filter=prod_no&dataID=" . $db->lastInsertedId());
	}else{
		Redirect::to("/akempco/{$page}");	
	}
	
	exit();
// }
	// $dataAttri->free();
	// $db->close();
?>

