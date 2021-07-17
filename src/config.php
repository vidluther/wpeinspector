<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('DEBUG', false); 
define('BASE_URL', 'https://api.wpengineapi.com/v1/'); 

require_once __DIR__ . '/includes/helpers.php'; 


// Load the environment variables that we'll need
// to authenticate against the API. 

define('WPE_USERNAME', $_ENV['api_username']); 
define('WPE_PASSWORD', $_ENV['api_password']); 