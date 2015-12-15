<?php

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=adlister_db', 'adlister_user', 'codeup');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$dbc->exec('DROP TABLE IF EXISTS ads');


$adTable = 'CREATE TABLE ads (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED NOT NULL,
	listing_date DATE,
	item VARCHAR(50),
	price VARCHAR(20),
	description VARCHAR(250),
	image VARCHAR(50), 
	FOREIGN KEY (user_id)
		REFERENCES user_account(id)
		ON DELETE CASCADE
)';

$dbc->exec($adTable);

