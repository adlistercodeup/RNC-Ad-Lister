<?php

session_start();

// Load the environment variables.
$_ENV = include '.env.php';

// require_once '../database/adlist_db_config.php';
require 'database/adlist_db_connect.php';

require_once 'utils/Input.php';
require_once 'utils/Logger.php';
require_once 'models/User.php';
require_once 'utils/Auth.php';



