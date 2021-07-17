<?php
/**
 * This file will generate the necessary YAML needed for upptimerc.yml
 * This will only create the YAML string if the site is in production and has a primary
 * domain attached to it.
 */
require 'vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Wpe\Api as wpe;

$client = new Wpe();

if ($client->checkStatus() === false) {

    echo "WPE Api System seems to be down..or we wrote crappy code" . PHP_EOL;
    exit(1);

}

$installs = $client->getInstalls();

$installsToMonitor = array();

// iterate through installs
foreach ($installs as $install) {

    $install_id = $install->id;
    $install_name = $install->name;
    $install_env = $install->environment;
    $install_cname = $install->cname;
    $install_phpversion = $install->php_version;
    $install_is_multisite = $install->is_multisite;
    $primary_domain = $install->primary_domain;

    if ($install->environment === 'production') {
        echo "Adding $install_name with $primary_domain to the monitor" . PHP_EOL;
    }
}

die;
