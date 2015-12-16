<?php

// copied this from my Log file will work more on this later.

require_once 'Logger.php';

class Auth {

	public static $password = '$2y$10$SLjwBwdOVvnMgWxvTI4Gb.YVcmDlPTpQystHMO2Kfyi/DS8rgA0Fm';

	public static function attempt($username, $password) {
		if (($username == 'guest') && (password_verify($password, self::$password)) {
				$_SESSION['LOGGED_IN_USER'] = true;
				$_SESSION['username'] = $username;

				$log->info("{$username} logged in successfully")
				return true;
		}

	

	public static function check() {
		if ($_SESSION['LOGGED_IN_USER'] == true) {
			return true;
		} else {
			return false;
		}

	public static function user() {
		return ($_SESSION['username']);

	}

	public static function logout(){
		if (isset($_SESSION['LOGGED_IN_USER']))
		{
			unset($_SESSION['LOGGED_IN_USER']);
		}
	}


	
