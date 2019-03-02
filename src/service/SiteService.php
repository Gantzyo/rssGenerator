<?php
namespace RssGenerator\Service;

use RssGenerator\Domain\Site as Site;
use RssGenerator\Repository\SiteRepository as SiteRepository;
use RssGenerator\Repository\FeedHasSiteRepository as FeedHasSiteRepository;

class SiteService
{
    /**
     * @return Site[]
     */
    public static function getActiveSites()
    {
        $rows = SiteRepository::findActiveSites();
        return self::getRowsAsSites($rows);
    }

    /**
     * @return Site[]
     */
    public static function getOrderedSitesByFeed(int $Feed_id) {
        $rows = FeedHasSiteRepository::findSitesByFeedOrderByUpdate($Feed_id);
        return self::getRowsAsSites($rows);
    }

    /**
     * @return Site[]
     */
    private static function getRowsAsSites(array $rows)
    {
        $sites = [];
        foreach ($rows as $row) {
            $sites[] = self::getRowAsSite($row);
        }
        return $sites;
    }

    private static function getRowAsSite(array $row): Site
    {
        $site = new Site();
        foreach ($row as $key => $value) {
            $site->{$key} = $value;
        }
        return $site;
    }
}
