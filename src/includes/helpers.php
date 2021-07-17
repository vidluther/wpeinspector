<?php
namespace Wpe;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Api
{
    private $_client;
    public $status;

    public function __construct()
    {
        $this->_client = new Client([
            // Base URI is used with relative requests
            'base_uri' => BASE_URL,
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);

    }

    public function checkStatus()
    {
        $response = $this->_client->request('GET', 'status');

        if ($this->checkIfResponseIsValid($response)) {
            $this->status = true;
        } else {
            $this->status = false;
        }

        return $this->status;
    }

    /**
     * Get a collection of installs at WPE
     */
    public function getInstalls()
    {
        $response = $this->request('GET', 'installs');
        if ($this->checkIfResponseIsValid($response)) {
            $body = $response->getBody();
            $installsCollection = json_decode($body);
            $installResults = $installsCollection->results;
            return $installResults;
        } else {
            return false;
        }

    }
    public function getSites()
    {
        // Get a list of sites at WPE, this will give us a list of installs automatically.

        $response = $this->request('GET', 'sites');
        if ($this->checkIfResponseIsValid($response)) {
            $body = $response->getBody();
            $sitesCollection = json_decode($body);
            $siteResults = $sitesCollection->results;
            return $siteResults;
        } else {
            return false;
        }

    }

    public function getAccountName($account_id)
    {
        $response = $this->request('GET', "accounts/$account_id");

        if ($this->checkIfResponseIsValid($response)) {
            $body = $response->getBody();
            $account_details = json_decode($body);
            return $account_details->name;
        } else {
            return false;
        }

    }

    public function getInstallDomain($install_id)
    {
        $install_details = $this->getInstallDetails($install_id);
        return $install_details->primary_domain;
    }

    public function getInstallDetails($install_id)
    {
        $response = $this->request('GET', "installs/$install_id");

        if ($this->checkIfResponseIsValid($response)) {
            $body = $response->getBody();
            $install_details = json_decode($body);
            return $install_details;
        } else {
            return false;
        }
    }

    private function request($method, $endpoint)
    {
        if (DEBUG === true) {
            echo "Making a $method request to $endpoint" . PHP_EOL;
        }
        $response = $this->_client->request($method, $endpoint, ['auth' => [WPE_USERNAME, WPE_PASSWORD]]);
        return $response;

    }

    private function checkIfResponseIsValid($response)
    {
        $rcode = $response->getStatusCode();

        if ($rcode === 200) {
            #echo "WP Engine API is Up and Running" . PHP_EOL;
            return true;
        } else {
            echo 'The API Responded with error (' . $rcode . ')' . PHP_EOL;
            return false;
        }
    }

}
