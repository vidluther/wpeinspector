<?php

require 'vendor/autoload.php';

require_once __DIR__ . '/config.php'; 

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => BASE_URL,
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);


// Send a request to https://BASE_URL/status to see if we can connect or not. 
$response = $client->request('GET', 'status');

$validResponse = \Helpers\Helper::checkIfResponseIsValid($response); 

if($validResponse === true ) {
    echo "WP Engine API Status is good" . PHP_EOL; 
} else {
    echo "WP Engine API Status is down " . PHP_EOL; 
    exit(1); 
}





// // Get a list of installs at WPE 
$installsResponse = $client->request('GET', 'installs', ['auth' => [WPE_USERNAME, WPE_PASSWORD]]); 

if (\Helpers\Helper::checkIfResponseIsValid($installsResponse) === true ) {
    echo "Got a valid response to installs" . PHP_EOL; 
    $body = $installsResponse->getBody(); // gives us json.   
    #echo $body->results;   
    $j = json_decode($body); 
    $results = $j->results;   
    foreach($results AS $install) {
        #print_r($install); 
        $name = $install->name; 
        $cname = $install->cname; 
        $primary_domain = $install->primary_domain; 
        $is_multisite = $install->$is_multisite; 
        $status = $install->status; 
        $php_version = $install->php_version; 
        $environment = $install->environment; 
        $site_id = $install->site->id; 

    }
} else {
    echo "Did not get a valid response of Installs" . PHP_EOL; 
}

// print_r($installsResponse); 