<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);    

    session_start();
    define('SITE_URL_FILE', $_SERVER['DOCUMENT_ROOT'] . "/akempco/");//PRODUCTION

	/**
	 * database config 
	 */

	$GLOBALS['config'] = array(
		'mysql' => array(//PRODUCTION
		 	'host' => 'localhost',
		 	'username' => 'root',
		 	'password' => 'Server@2026', //p@$$dB
		 	'db' => 'akempcodb'
		),			
		'remember' => array(
			'cookie_name' => 'hash',
			'cookie_expiry' => '604800'
		),
		'session' => array(
			'session_name' => 'akemp_user',
			'token_name' => 'token'
		)

	);	

	spl_autoload_register(function($class){
		require_once SITE_URL_FILE . 'classes/' . $class . '.php';
	});

	try {

		$db = new Mysqli_Manager();

	} catch (Exception $err) {

		exit($err->getMessage());
	}



	if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
		$hash = Cookie::get(Config::get('remember/cookie_name'));
		$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

		if($hashCheck->count()){
			$user = new User($hashCheck->first()->user_id);
			$user->login();
		}
	}

  // if(!isset($_SESSION['login_member_role']))  {
  //   Redirect::to("login.php");
  // }
?>