<?php 
namespace Helpers; 

class Helper {
    static function checkIfResponseIsValid($response) {
        $rcode = $response->getStatusCode(); 

        if($rcode === 200) {
            #echo "WP Engine API is Up and Running" . PHP_EOL; 
            return true; 
        } else {
            echo 'The API Responded with error ('. $rcode . ')' . PHP_EOL; 
            return false; 
        }
    }
}