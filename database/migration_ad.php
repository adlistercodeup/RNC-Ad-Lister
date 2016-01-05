<?php

require_once 'adlist_db_config.php';
require_once 'adlist_db_connect.php';

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$dbc->exec('DROP TABLE IF EXISTS ads');

$adTable = 'CREATE TABLE ads (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED NOT NULL,
	listing_date DATETIME,
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

