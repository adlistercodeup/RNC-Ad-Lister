<?php

/* This file creates the table in the database holds the migration structure of the database */

// Created the database (adlister_db) in MYSQL

// Use the PDO object to get connection to the database
require_once 'adlist_db_config.php';
require_once 'adlist_db_connect.php';

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$dbc->exec('DROP TABLE IF EXISTS ads');
$dbc->exec('DROP TABLE IF EXISTS user_account');

$userTable = 'CREATE TABLE user_account (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(50) NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	user_name VARCHAR(50) NOT NULL,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	zipcode CHAR(5)
	)';

$dbc->exec($userTable);

$adTable = 'CREATE TABLE ads (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED NOT NULL,
	listing_date DATE,
	item_name VARCHAR(50),
	price VARCHAR(20),
	image VARCHAR(50), 
	description VARCHAR(250),
	status VARCHAR(10),
	FOREIGN KEY (user_id)
		REFERENCES user_account(id)
		ON DELETE CASCADE
)';

$dbc->exec($adTable);





