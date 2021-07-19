<?php
/**
 * This file will generate the necessary YAML needed for upptimerc.yml
 * This will only create the YAML string if the site is in production and has a primary
 * domain attached to it.
 */
require 'vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Symfony\Component\Yaml\Yaml;
use Wpe\Api as wpe;

$client = new Wpe();

if ($client->checkStatus() === false) {

    echo "WPE Api System seems to be down..or we wrote crappy code" . PHP_EOL;
    exit(1);

}

$installs = $client->getInstalls();

// $installsToMonitor['sites'] = array();
$installsToMonitor = ['sites' => []];

// iterate through installs
foreach ($installs as $install) {

    #print_r($install);die;

    $install_id = $install->id;
    $install_name = $install->name;
    $install_env = $install->environment;
    $install_cname = $install->cname;
    $install_phpversion = $install->php_version;
    $install_is_multisite = $install->is_multisite;
    $primary_domain = $install->primary_domain;

    if ($install->environment === 'production') {
        $object = new \stdClass();
        $object->name = $install_name;
        $object->url = $primary_domain;
        // echo "Adding $install_name with $primary_domain to the monitor ($install_env)" . PHP_EOL;

        #$installsToMonitor[] = array('name' => $install->name, 'url' => $install->primary_domain);

        $installsToMonitor['sites'][] = [
            'name' => $install->name,
            'url' => 'https://'.$install->primary_domain,
        ];
    }

}

echo yaml_emit($installsToMonitor); 

#$yaml = Yaml::dump($installsToMonitor); //, 2, 4, Yaml::DUMP_OBJECT_AS_MAP);
#print_r($installsToMonitor);
#echo $dumped;
#echo $yaml;
