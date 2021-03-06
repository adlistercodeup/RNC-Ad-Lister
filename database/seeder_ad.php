<?php

require_once 'adlist_db_config.php';
require_once 'adlist_db_connect.php';

$dbc->exec('TRUNCATE TABLE ads');

$adLists = [
	['user_id' => '1', 'listing_date' => '2014-05-28', 'item_name' => 'bags', 'price' => '20', 'image' => '1.png', 'description' => 'good', 'status'= 'active'],
	['user_id' => '2', 'listing_date' => '2014-05-28', 'item_name' => 'shoes', 'price' => '10', 'image' => '2.png', 'description' => 'good', 'status'= 'inactive'],
	['user_id' => '3', 'listing_date' => '2015-06-28', 'item_name' => 'clothes', 'price' => '10', 'image' => '3.png', 'description' => 'good', 'status'= 'active'],
	['user_id' => '3', 'listing_date' => '2015-06-28', 'item_name' => 'bags', 'price' => '10', 'image' => '4.png', 'description' => 'good', 'status'= 'inactive'],
	['user_id' => '3', 'listing_date' => '2015-05-28', 'item_name' => 'shoes', 'price' => '10', 'image' => '5.png', 'description' => 'good', 'status'= 'inactive']
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



