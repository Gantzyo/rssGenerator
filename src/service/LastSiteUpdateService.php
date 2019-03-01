<?php
namespace RssGenerator\Service;

use RssGenerator\Domain\Site as Site;
use RssGenerator\Domain\LastSiteUpdate as LastSiteUpdate;
use RssGenerator\Repository\LastSiteUpdateRepository as LastSiteUpdateRepository;

class LastSiteUpdateService
{
    public static function getLastSiteUpdate(Site $site): LastSiteUpdate
    {
        $row = LastSiteUpdateRepository::findBySite($site->id);
        return self::getRowAsLastSiteUpdate($site, $row);
    }

    public static function update(Site $site, string $newUpdate)
    {
        LastSiteUpdateRepository::updateLastSiteUpdate($site->id, $newUpdate);
    }

    private static function getRowAsLastSiteUpdate(Site $site, ?array $row): LastSiteUpdate
    {
        $lastSiteUpdate = new LastSiteUpdate();
        if($row === null) {
            $lastSiteUpdate->Site_id = $site->id;
        } else {
            foreach ($row as $key => $value) {
                $lastSiteUpdate->{$key} = $value;
            }
        }
        return $lastSiteUpdate;
    }
}
