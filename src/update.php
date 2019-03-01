<?php
require __DIR__ . '/vendor/autoload.php';

use RssGenerator\Processor\SiteProcessorChooser as SiteProcessorChooser;
use RssGenerator\Db\ConnectionFactory as ConnectionFactory;
use RssGenerator\Service\CookieService as CookieService;
use RssGenerator\Service\SiteService as SiteService;
use RssGenerator\Service\LastSiteUpdateService as LastSiteUpdateService;

// Uncomment to unlimit var_dump
ini_set('xdebug.var_display_max_depth', '-1');
ini_set('xdebug.var_display_max_children', '-1');
ini_set('xdebug.var_display_max_data', '-1');

$sites = SiteService::getActiveSites();

$cookies = [];

foreach ($sites as $site) {
    // Retrieve value from site
    if (!isset($cookies[$site->Type_type])) {
        $cookies[$site->Type_type] = CookieService::getSiteCookies($site);
    }
    $processor = SiteProcessorChooser::getProcessor($site);
    $result = $processor->getSiteUpdate($site, $cookies[$site->Type_type]);

    // Retrieve last known value from database
    $lastSiteUpdate = LastSiteUpdateService::getLastSiteUpdate($site);

    // Update when value changes
    if($result !== $lastSiteUpdate->lastUpdate) {
        LastSiteUpdateService::update($site, $result);
    }
}

var_dump(ConnectionFactory::getFactory()->getConnection()->log());