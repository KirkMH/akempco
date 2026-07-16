<?php
/*
Daya nga class hay para sa CSRF protection. Ma obra anay it token ngara ag e ibutang 
sa form pero nakatago tapos e save man dayun imaw sa session. Ro token ngara hay 
iba kada generate it page. Para kung mag submit man imaw gamit du POST o ro GET hay echeck na anay
ro token kung may una ag kung parehas. Kung minatuod ro daywa nga kundisyon hay paeaon na eon du 
token ngato sa session.
*/
class Token{
	public static function generate(){
		return Session::put(Config::get('session/token_name'), md5(uniqid()));
	}

	public static function check($token){//check kung ro token gaexist sa session 
		$tokenName = Config::get('session/token_name');

		if(Session::exists($tokenName) && $token === Session::get($tokenName)){
			Session::delete($tokenName);//nakumpara kung ro token nga
			return true;//gintago hay parehas sa page nga gin generate
		}

		return false;
	}
}



?>