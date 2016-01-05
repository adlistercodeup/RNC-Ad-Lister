<?php

require_once 'adlist_db_config.php';
require_once 'adlist_db_connect.php';

$dbc->exec('TRUNCATE TABLE user_account');

$userLists = [
	['first_name' => 'Crystal', 'last_name' => 'Nah', 'user_name' => 'crytal_nah', 'password' => 'djh', 'email' => 'crystal@ad.com', 'zipcode' => '12345'],
	['first_name' => 'Crystal1', 'last_name' => 'Nah', 'user_name' => 'crytal1_nah', 'password' => 'mhfhj', 'email' => 'crystal1@ad.com', 'zipcode' => '23456'],
	['first_name' => 'Crystal2', 'last_name' => 'Nah', 'user_name' => 'crytal2_nah', 'password' => 'jfdj', 'email' => 'crystal2@ad.com', 'zipcode' => '34567'],
	['first_name' => 'Crystal3', 'last_name' => 'Nah', 'user_name' => 'crytal3_nah', 'password' => ',ds,', 'email' => 'crystal3@ad.com', 'zipcode' => '45678'],
	['first_name' => 'Crystal4', 'last_name' => 'Nah', 'user_name' => 'crytal4_nah', 'password' => 'jnmdsaj', 'email' => 'crystal4@ad.com', 'zipcode' => '56789']
];


foreach ($userLists as $userList) 
{
	$userData = 'INSERT INTO user_account (first_name, last_name, user_name, password, email, zipcode)
							VALUES (:first_name, :last_name, :user_name, :password, :email, :zipcode)';

				$stmt = $dbc->prepare($userData);
			
				$stmt->bindValue(':first_name', $userList['first_name'], PDO::PARAM_STR);
				$stmt->bindValue(':last_name', $userList['last_name'], PDO::PARAM_STR);
				$stmt->bindValue(':user_name', $userList['user_name'], PDO::PARAM_STR);
				$stmt->bindValue(':password', $userList['password'], PDO::PARAM_STR);
				$stmt->bindValue(':email', $userList['email'], PDO::PARAM_STR);
				$stmt->bindValue(':zipcode', $userList['zipcode'], PDO::PARAM_INT);

	$stmt->execute();
}