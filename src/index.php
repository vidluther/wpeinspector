<?php

require 'vendor/autoload.php';
require_once __DIR__ . '/config.php';

use League\Csv\Writer;
use Wpe\Api as wpe;

$client = new Wpe();

if ($client->checkStatus() === false) {

    echo "WPE Api System seems to be down..or we wrote crappy code" . PHP_EOL;
    exit(1);

}

$sites = $client->getSites();
#print_r($sites); 
#die; 
$csvHeader = ['account_name', 'account_id', 'site_id', 'site name', 'install id', 'install name', 'install environment', 'install cname', 'php version', 'is multisite', 'primary domain'];
//we create the CSV into memory
$csv = Writer::createFromFileObject(new SplTempFileObject());

//insert the header
$csv->insertOne($csvHeader);

$csvRecords = array();
foreach ($sites as $site) {
    // This is another call to the API.. we should probably make a local map
    // of account ids to account names
    $account_name = $client->getAccountName($site->account->id);
    $site_id = $site->id;
    $site_name = $site->name;
    $installs = $site->installs;

    // iterate through installs
    foreach ($installs as $install) {
        $install_id = $install->id;
        $install_name = $install->name;
        $install_env = $install->environment;
        $install_cname = $install->cname;
        $install_phpversion = $install->php_version;
        $install_is_multisite = $install->is_multisite;
        // If we want to know the domain associated with the site, we need to call /installs/$install_id at WPE
        $install_primary_domain = $client->getInstallDomain($install_id);
        //$install_primary_domain = "doo.com"; // this was added here just to speed up execution during testing.
        $csvRecords[] = [$account_name, $site->account->id, $site_id, $site_name, $install_id, $install_name, $install_env, $install_cname, $install_phpversion, $install_is_multisite, $install_primary_domain];

    }
}
$csv->insertAll($csvRecords);
$csv->output('wpesites.csv');
die;
