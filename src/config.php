<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('BASE_URL', 'https://api.wpengineapi.com/v1/'); 

require_once __DIR__ . '/includes/helpers.php'; 

// username: f306b57d-6e75-4fe3-b3d3-ef13764b8ca6
// password: cmMF4UvkUP6pjocy3bGN9g==

define('WPE_USERNAME', $_ENV['api_username']); 
define('WPE_PASSWORD', $_ENV['api_password']); 

$cred_string = $_ENV['api_username']. ":" . $_ENV['api_password']; 

$headers[] = "Authorization: Basic " . base64_encode($cred_string);