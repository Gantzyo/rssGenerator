<?php
namespace RssGenerator\Repository;

use RssGenerator\Db\ConnectionFactory as ConnectionFactory;
use RssGenerator\Domain\Cookie as Cookie;
use RssGenerator\Util\RepositoryUtils as RepositoryUtils;

class CookieRepository
{
    public static function findByType(string $type): array
    {
        $db = ConnectionFactory::getFactory()->getConnection();
        return $db->select("cookie", RepositoryUtils::getDomainColumns(Cookie::class), [
            "Type_type" => $type,
        ]);
    }
}
