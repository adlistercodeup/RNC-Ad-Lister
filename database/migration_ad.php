<?php

require_once 'adlist_db_config.php';
require_once 'adlist_db_connect.php';

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

