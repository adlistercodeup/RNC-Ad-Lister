<?php

// copied this from my Log file will work more on this later.

require_once 'Logger.php';
require_once 'Input.php';
require_once '../models/User.php';

class Auth {

	
	public static function attempt($username, $password) {


		$log = new Log();
		$newUser = User::findUser($username);

	
		

		if (($username == $newUser->username) && (password_verify($password, $hashedpassword))) {
				$_SESSION['LOGGED_IN_USER'] = true;
				$_SESSION['username'] = $username;

				$log->info("{$username} logged in successfully");
		}
				return true;
	}

	

	public static function check() {
		if ($_SESSION['LOGGED_IN_USER'] == true) {
			return true;
		} else {
			return false;
		}

	public static function user() {
		if ($_SESSION['LOGGED_IN_USER'){
			$_SESSION['LOGGED_IN_USER'] = $username;

		}
		return $username;	
	}

	public static function logout(){
		if (isset($_SESSION['LOGGED_IN_USER'])) {
			unset($_SESSION['LOGGED_IN_USER']);
		}
	}


	
