
<?php

// copied this from my Log file will work more on this later.

require_once 'Logger.php';
require_once 'Input.php';
require_once '../models/User.php';

class Auth {

	protected static $username;
	protected static $password;

	protected static function setStatic($username){
		$user = User::findUser($username);
		var_dump($user);

		self::$username = $user->attributes['username'];
		self::$password = $user->attributes['password'];
	}

	
	public static function attempt($username, $password) {


		$log = new Log();
		
		self::setStatic($username);

		if (($username == self::username) && (password_verify($password, self::$password))) {
			$_SESSION['LOGGED_IN_USER'] = $username;
			return true;
		} else {
			return false;
		}
	}

	

	public static function check() {
		if ($_SESSION['LOGGED_IN_USER'] == true) {
			return true;
		} else {
			return false;
		}
	}

	public static function user() {
		if ($_SESSION['LOGGED_IN_USER']){

			$_SESSION['LOGGED_IN_USER'] = $username;

		}
		return $username;	
	}

	public static function logout(){
		if (isset($_SESSION['LOGGED_IN_USER'])) {
			unset($_SESSION['LOGGED_IN_USER']);
		}
	}

}



