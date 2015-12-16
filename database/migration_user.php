<?php

/* This file holds the creates the database and tables and holds the migration structure of the database */

// Created the database (adlister_db) in MYSQL

// Use the PDO object to get connection to the database


require_once 'adlist_db_config.php';
require_once 'adlist_db_connect.php';


echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$dbc->exec('DROP TABLE IF EXISTS user_account');



$userTable = 'CREATE TABLE user_account (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(50) NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	user_name VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	zipcode CHAR(5)
	)';

$dbc->exec($userTable);



