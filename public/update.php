<?php
require __DIR__ . '/../vendor/autoload.php';

use RssGenerator\Processor\SiteProcessorChooser as SiteProcessorChooser;
use RssGenerator\Service\CookieService as CookieService;
use RssGenerator\Service\SiteService as SiteService;
use RssGenerator\Service\LastSiteUpdateService as LastSiteUpdateService;
use RssGenerator\Db\ConnectionFactory as ConnectionFactory;
use RssGenerator\Domain\Site as Site;

ignore_user_abort(true);

// Uncomment to unlimit var_dump
// ini_set('xdebug.var_display_max_depth', '-1');
// ini_set('xdebug.var_display_max_children', '-1');
// ini_set('xdebug.var_display_max_data', '-1');

$sites = SiteService::getActiveSites();

echo "Recuperados ".sizeof($sites)." sitios activos";
echo "<br/>";
echo "<br/>";

$cookies = [];

foreach ($sites as $site) {
    echo "* Comprobando ".$site->name;
    echo "<br/>";
    // Retrieve cookies for this type of site
    if (!isset($cookies[$site->Type_type])) {
        $cookies[$site->Type_type] = CookieService::getSiteCookies($site);
    }
    
    // Process site
    $processor = SiteProcessorChooser::getProcessor($site);
    $result = $processor->getSiteUpdate($site, $cookies[$site->Type_type]);
    echo "Nuevo valor: [".$result."]";
    echo "<br/>";

    // Retrieve last known value from database
    $lastSiteUpdate = LastSiteUpdateService::getLastSiteUpdate($site);
    echo "Valor anterior: [".$lastSiteUpdate->lastUpdate."]";
    echo "<br/>";

    // Update when value changes
    if(!empty($result) && $result !== $lastSiteUpdate->lastUpdate) {
        LastSiteUpdateService::update($site, $result);
    }
    echo "<br/>";
}

// echo "Queries: <br/>";
// $db = ConnectionFactory::getFactory()->getConnection();
// print_r($db->info());
// echo "<br/>";
// echo "<br/>";
// echo "Log:";
// echo "<br/>";
// print_r($db->log());

echo "OK";
