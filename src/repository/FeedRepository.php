<?php
namespace RssGenerator\Repository;

use RssGenerator\Db\ConnectionFactory as ConnectionFactory;
use RssGenerator\Domain\Feed as Feed;
use RssGenerator\Util\RepositoryUtils as RepositoryUtils;

class FeedRepository
{
    public static function findById(int $id): array
    {
        $db = ConnectionFactory::getFactory()->getConnection();
        return $db->select("feed", RepositoryUtils::getDomainColumns(Feed::class), [
            "id" => $id,
            "enabled" => true,
        ]);
    }
}
