<?php
namespace RssGenerator\Repository;

use RssGenerator\Db\ConnectionFactory as ConnectionFactory;
use RssGenerator\Domain\FeedHasSite as FeedHasSite;
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
}
