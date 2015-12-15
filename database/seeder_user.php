<?php

require_once 'adlist_db_config.php';
require_once 'adlist_db_connect.php';

$dbc->exec('TRUNCATE TABLE user_account');