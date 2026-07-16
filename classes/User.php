<?php

class User{
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

	public function __construct($user = null){
		$this->_db = Mysqli_Manager::getInstance();

		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		if(!$user){
			if(Session::exists($this->_sessionName)){
				$user = Session::get($this->_sessionName);

				if($this->find($user)){
					$this->_isLoggedIn = true;
				}else {
					//process logout
				}
			}
		}else{
			$this->find($user);
		}
	}

	public function update($table, $fields = array(), $id = null){
		if(!$id && $this->isLoggedIn()){
			$id = $this->data()->user_no;
		}
		if(!$this->_db->update($table, $fields,'user_no', $id )){
			throw new Exception("There was a problem updating.");
		}
	}

	public function create($fields = array()){
		if(!$this->_db->insert('tbl_users',$fields)){//this is to be inserted in users table
			throw new Exception("There was a problem creating account.");
		}
	}
	public function find($user = null){
		if($user){
			$field = (is_numeric($user)) ? 'user_no' : 'username';//pili kung ano ro gin set id o username
			// $db->select_one('*', $table, "WHERE {$filter} = '$dataID'");		
			$data = $this->_db->select_one('*','tbl_users', "WHERE {$field} = '{$user}'");

			if($data){
				$this->_data = $data;

        // $user = $user->find("qwerty");
        // echo $user['user_no'];				
				// echo $this->data()->user_no;
				return true;
			}
		}
		return false;
	}

	public function login($username = null , $password = null, $remember = false){
		$user = $this->find($username);
		if(!$username && !$password && $this->exists()){
			Session::put($this->_sessionName, $this->data()->user_no);
		}else{
		// $user = $this->find($username);

			if($user){
				// if($this->data()->password === Hash::make($password, $this->data()->salt)){
				if($this->data()->password === Hash::make($password)){
    				// if(!$this->hasPermission('inactive')) {//kun bukon dugagamit hay aktibo
       
							Session::put($this->_sessionName, $this->data()->user_no);

							if($remember){
								$hash = Hash::unique();
								$hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->user_id));

								if(!$hashCheck->count()){
									$this->_db->insert('users_session',array(
										'user_id' => $this->data()->user_no,
										'hash' => $hash
										));
								}else{
									$hash = $hashCheck->first()->hash;
								}
								Cookie::put($this->_cookieName,$hash, Config::get('remember/cookie_expiry'));
							}
							return true;
    				/*}else{
					    	Session::flash('loginError', 'Please activate your account now!');
					    	return false;
				    }	*/				
				}
			}
		}
		Session::flash('loginError', 'Please enter a correct username and password. Note that both fields are case-sensitive.');
		return false;
	}

	public function hasPermission($key){//daya nga function hay para sa page nga sugtan ah. bantay daya
		$group = $this->_db->get('groups', array('id', '=', $this->data()->grp));

		if($group->count()){
			$permissions = json_decode($group->first()->permissions, true);

			if($permissions[$key] == true){
				return true;
			}
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}
	
	public function logout(){
		$this->_db->delete('users_session', array('user_id', '=', $this->data()->user_no));

		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}

	public function data(){
		return $this->_data;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}

    public function sendActivation($to, $subject, $message) {
		$to = "herminioyatarjr@gmail.com";
		$subject = "Versebuster Account Activation test";

		// $message = "
		// <html><head><title>HTML email</title></head>
		// <body><p>This email contains HTML Tags!</p>
		// <table><tr><th>Firstname</th><th>Lastname</th></tr>
		// <tr><td>John</td><td>Doe</td></tr></table>
		// </body>
		// </html>
		// ";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <webmaster@versebuster.com>' . "\r\n";
		$headers .= 'Cc: herminioyatarjr@gmail.com' . "\r\n";

		mail($to,$subject,$message,$headers);
    }	
}