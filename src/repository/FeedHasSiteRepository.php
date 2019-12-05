<?php
namespace RssGenerator\Repository;

use RssGenerator\Db\ConnectionFactory as ConnectionFactory;
use RssGenerator\Domain\FeedHasSite as FeedHasSite;
use RssGenerator\Domain\Site as Site;
use RssGenerator\Util\RepositoryUtils as RepositoryUtils;

class FeedHasSiteRepository
{
    public static function findByFeed(int $id): array
    {
        $db = ConnectionFactory::getFactory()->getConnection();
        return $db->select("feed_has_site", RepositoryUtils::getDomainColumns(FeedHasSite::class), [
            "Feed_id" => $id,
            "enabled" => true,
        ]);
    }

    public static function findSitesByFeedOrderByUpdate(int $id): array
    {
        /*
        SELECT s.* FROM rssgenerator_feed_has_site fhs
        INNER JOIN rssgenerator_site s ON fhs.Site_id=s.id
        INNER JOIN rssgenerator_last_site_update lsu ON lsu.Site_id = s.id
        WHERE fhs.Feed_id = 1
        AND fhs.enabled = TRUE
        ORDER BY lsu.updateTS DESC, s.id ASC;
         */
        $db = ConnectionFactory::getFactory()->getConnection();
        return $db->select("feed_has_site", [
            "[><]site" => ["feed_has_site.Site_id" => "id"],
            "[><]last_site_update" => ["site.id" => "Site_id"],
        ], RepositoryUtils::getDomainColumns(Site::class, "site"), [
            "feed_has_site.Feed_id" => $id,
            "feed_has_site.enabled" => true,
            "ORDER" => [
                "last_site_update.updateTS" => "DESC",
                "site.id" => "ASC",
            ],
        ]);
    }
}
