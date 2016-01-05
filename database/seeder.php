<?php

/* The file puts some data in the database for testing */

require_once 'adlist_db_config.php';
require_once 'adlist_db_connect.php';

// SET FOREIGN_KEY_CHECKS = 0;
// $dbc->exec('TRUNCATE TABLE ads');
// $dbc->exec('TRUNCATE TABLE user_account');
// SET FOREIGN_KEY_CHECKS = 1;

$dbc->exec('DELETE FROM ads');
$dbc->exec('DELETE FROM user_account');

$userLists = [
	['first_name' => 'Crystal', 'last_name' => 'Nah', 'user_name' => 'crystal_nah', 'password' => 'djh', 'email' => 'crystal@ad.com', 'zipcode' => '12345'],
	['first_name' => 'Crystal1', 'last_name' => 'Nah', 'user_name' => 'crystal1_nah', 'password' => 'mhfhj', 'email' => 'crystal1@ad.com', 'zipcode' => '23456'],
	['first_name' => 'Crystal2', 'last_name' => 'Nah', 'user_name' => 'crystal2_nah', 'password' => 'jfdj', 'email' => 'crystal2@ad.com', 'zipcode' => '34567'],
	['first_name' => 'Crystal3', 'last_name' => 'Nah', 'user_name' => 'crystal3_nah', 'password' => ',ds,', 'email' => 'crystal3@ad.com', 'zipcode' => '45678'],
	['first_name' => 'Crystal4', 'last_name' => 'Nah', 'user_name' => 'crystal4_nah', 'password' => 'jnmdsaj', 'email' => 'crystal4@ad.com', 'zipcode' => '56789']
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

$adLists = [
	['user_id' => '1', 'listing_date' => '2014-05-28', 'item_name' => 'bags', 'price' => '20', 'image' => '1.png', 'description' => 'good', 'status' => 'active'],
	['user_id' => '2', 'listing_date' => '2014-05-28', 'item_name' => 'shoes', 'price' => '10', 'image' => '2.png', 'description' => 'good', 'status' => 'inactive'],
	['user_id' => '3', 'listing_date' => '2015-06-28', 'item_name' => 'clothes', 'price' => '10', 'image' => '3.png', 'description' => 'good', 'status' => 'active'],
	['user_id' => '3', 'listing_date' => '2015-06-28', 'item_name' => 'bags', 'price' => '10', 'image' => '4.png', 'description' => 'good', 'status' => 'inactive'],
	['user_id' => '3', 'listing_date' => '2015-05-28', 'item_name' => 'shoes', 'price' => '10', 'image' => '5.png', 'description' => 'good', 'status' => 'inactive']
];

$stmt = $dbc->prepare('INSERT INTO ads (user_id, listing_date, item_name, price, image, description, status)
						VALUES (:user_id, :listing_date, :item_name, :price, :image, :description, :status)');

foreach ($adLists as $adList) 
{
	$stmt->bindValue(':user_id', $adList['user_id'], PDO::PARAM_INT);
	$stmt->bindValue(':listing_date', $adList['listing_date'], PDO::PARAM_STR);
	$stmt->bindValue(':item_name', $adList['item_name'], PDO::PARAM_STR);
	$stmt->bindValue(':price', $adList['price'], PDO::PARAM_INT);
	$stmt->bindValue(':image', $adList['image'], PDO::PARAM_STR);
	$stmt->bindValue(':description', $adList['description'], PDO::PARAM_STR);
	$stmt->bindValue(':status', $adList['status'], PDO::PARAM_STR);

	$stmt->execute();
}

