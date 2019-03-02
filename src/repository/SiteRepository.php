<?php
namespace RssGenerator\Repository;

use RssGenerator\Db\ConnectionFactory as ConnectionFactory;
use RssGenerator\Domain\Site as Site;
use RssGenerator\Util\RepositoryUtils as RepositoryUtils;

class SiteRepository
{
    public static function findById(int $id): array
    {
        $db = ConnectionFactory::getFactory()->getConnection();
        return $db->select("site", RepositoryUtils::getDomainColumns(Site::class), [
            "id" => $id,
        ]);
    }

    public static function findEnabledSites(): array
    {
        $db = ConnectionFactory::getFactory()->getConnection();
        return $db->select("site", RepositoryUtils::getDomainColumns(Site::class), [
            "enabled" => true,
        ]);
    }

    public static function findActiveSites(): array
    {
        $db = ConnectionFactory::getFactory()->getConnection();
        return $db->select("site", [
            "[>]feed_has_site" => ["site.id" => "Site_id"],
        ], RepositoryUtils::getDomainColumns(Site::class, "site"), [
            "site.enabled" => true,
            "feed_has_site.enabled" => true,
        ]);
    }
}
