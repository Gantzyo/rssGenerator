<?php
require __DIR__ . '/vendor/autoload.php';

use RssGenerator\Service\LastSiteUpdateService as LastSiteUpdateService;
use RssGenerator\Service\SiteService as SiteService;
use RssGenerator\Util\RssUtils as RssUtils;

ignore_user_abort(true);

$feedId = isset($_GET["id"]) ? $_GET["id"] : "";

if (!empty($feedId)) {

    header("Content-Type: application/rss+xml; charset=utf-8");

    $sites = SiteService::getOrderedSitesByFeed($feedId);
    $calledUrl = RssUtils::curPageURL();

    $xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
    $xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
    $xml .= '<channel>' . "\n";
    $xml .= '<atom:link href="' . $calledUrl . '" rel="self" type="application/rss+xml" />' . "\n";
    $xml .= '<title>Sites updates</title>' . "\n";
    $xml .= '<link>' . $calledUrl . '</link>' . "\n";
    $xml .= '<description></description>' . "\n";

    foreach ($sites as $site) {
        $lastSiteUpdate = LastSiteUpdateService::getLastSiteUpdate($site);
        $updateHasError = (substr($lastSiteUpdate->lastUpdate, 0, 7) === '[ERROR]');

        $xml .= '<item>' . "\n";
        if ($updateHasError) {
            $xml .= '<title>[ERROR] ' . $site->name . ' at ' . $lastSiteUpdate->updateTS . '</title>' . "\n";
        } else {
            $xml .= '<title>' . $lastSiteUpdate->lastUpdate . '</title>' . "\n";
        }
        $xml .= '<link>' . $site->url . '</link>' . "\n";
        $xml .= '<description>' . "\n";
        $xml .= '<![CDATA[';
        if ($updateHasError) {
            $xml .= '<p>' . $lastSiteUpdate->lastUpdate . '</p>';
        } else {
            $xml .= '<p><a href="' . $site->url . '" target="_blank">' . $lastSiteUpdate->lastUpdate . '</a></p>';
        }
        $xml .= ']]>';
        $xml .= '</description>' . "\n";
        $xml .= '<pubDate>' . RssUtils::timestampToRFC822($lastSiteUpdate->updateTS) . '</pubDate>' . "\n";
        $xml .= '<guid isPermaLink="false">' . \urlencode($lastSiteUpdate->updateTS . "-" . $lastSiteUpdate->Site_id) . '</guid>' . "\n"; // unique ID -> updateTS-Site_id
        $xml .= '</item>' . "\n";
    }

    $xml .= '</channel>' . "\n";
    $xml .= '</rss>';

    echo $xml;

} else {
    echo "Error";
}
