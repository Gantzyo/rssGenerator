<?php
require __DIR__ . '/vendor/autoload.php';

use RssGenerator\Service\SiteService as SiteService;
use RssGenerator\Service\LastSiteUpdateService as LastSiteUpdateService;

ignore_user_abort(true);

$feedId = isset($_GET["id"]) ? $_GET["id"] : "";

if(!empty($feedId)) {

    header("Content-Type: application/rss+xml; charset=utf-8");

    $sites = SiteService::getOrderedSitesByFeed($feedId);

    $xml = '<?xml version="1.0" encoding="ISO-8859-1"?>' . "\n";
    $xml .= '<rss version="2.0">' . "\n";
    $xml .= '<channel>' . "\n";
    $xml .= '<title>Sites updates</title>' . "\n";
    $xml .= '<link></link>' . "\n";
    $xml .= '<description></description>' . "\n";

    foreach ($sites as $site) {
        $lastSiteUpdate = LastSiteUpdateService::getLastSiteUpdate($site);

        $xml .= '<item>' . "\n";
        $xml .= '<title>' . $site->name . '</title>' . "\n";
        $xml .= '<link>' . $site->url . '</link>' . "\n";
        $xml .= '<description>' . "\n";
        $xml .= '<![CDATA[';
        $xml .= '<p><b><a href="' . $site->url . '" target="_blank">' . $lastSiteUpdate->lastUpdate . '</a></b></p>';
        $xml .= ']]>';
        $xml .= '</description>' . "\n";
        $xml .= '<pubDate>' . $lastSiteUpdate->updateTS . '</pubDate>' . "\n";
        $xml .= '<guid>' . $lastSiteUpdate->updateTS . "-" . $lastSiteUpdate->Site_id . '</guid>' . "\n";// unique ID -> updateTS-Site_id
        $xml .= '</item>' . "\n";
    }

    $xml .= '</channel>' . "\n";
    $xml .= '</rss>';

    echo $xml;

} else {
    echo "Error";
}
