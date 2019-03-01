<?php
namespace RssGenerator\Repository;

use RssGenerator\Db\ConnectionFactory as ConnectionFactory;
use RssGenerator\Domain\LastSiteUpdate as LastSiteUpdate;
use RssGenerator\Util\RepositoryUtils as RepositoryUtils;

class LastSiteUpdateRepository
{
    public static function findBySite(int $Site_id): ?array
    {
        $db = ConnectionFactory::getFactory()->getConnection();
        return $db->get("last_site_update", RepositoryUtils::getDomainColumns(LastSiteUpdate::class), [
            "Site_id" => $Site_id,
        ]);
    }

    public static function updateLastSiteUpdate(int $Site_id, string $newUpdate)
    {
        $db = ConnectionFactory::getFactory()->getConnection();

        if ($db->has("last_site_update", ["Site_id" => $Site_id])) {
            $db->update("last_site_update", [
                "lastUpdate" => $newUpdate,
            ], [
                "Site_id" => $Site_id,
            ]);
        } else {
            $db->insert("last_site_update", [
                "lastUpdate" => $newUpdate,
                "Site_id" => $Site_id,
            ]);
        }
    }
}
