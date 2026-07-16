<?php 

/**
 * database config 
 */

/*define('DB_HOST', 'localhost'); //host
define('DB_USER', 'root'); // db username
define('DB_PASS', '1234567890-'); // db password 
define('DB_NAME', 'sample'); // db name*/

// require 'Mysqli_Manager.php';

try {

	$db = new Mysqli_Manager();

} catch (Exception $err) {

	exit($err->getMessage());
}
