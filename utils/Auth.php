
<?php

// copied this from my Log file will work more on this later.

require_once 'Logger.php';
require_once 'Input.php';
require '../models/User.php';

class Auth 
{
	protected static $username;
	protected static $password;

	protected static function setStatic($username)
	{
		$user = User::findUser($username);

		// var_dump($user);

		self::$username = $user->attributes['username'];
		self::$password = $user->attributes['password'];
	}

	
	public static function attempt($username, $password) 
	{


		$log = new Log();
		
		self::setStatic($username);

		if (($username == self::$username) && (password_verify($password, self::$password))) 
		{
			$_SESSION['LOGGED_IN_USER'] = $username;
			$user = User::findUser($username);
			$_SESSION['USER_ID'] = $user->id;

			return true;
		} else {
			return false;
		}
	} 

	public static function id()
	{
		return isset($_SESSION['USER_ID']) ? $_SESSION['USER_ID'] : null;
	}

	public static function check() 
	{
		if (isset($_SESSION['LOGGED_IN_USER']) && $_SESSION['LOGGED_IN_USER'] != "") 
		{
			return true;
		} else {
			return false;
		}
	}

	public static function user() 
	{
		if (isset($_SESSION['LOGGED_IN_USER'])) 
		{
			return $_SESSION['LOGGED_IN_USER'];			
		} else {
			return null;
		}
	}

	public static function logout()
	{	
		if (isset($_SESSION['LOGGED_IN_USER'])) 
	{
			unset($_SESSION['LOGGED_IN_USER']);
		}
	}

}



