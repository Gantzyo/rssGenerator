<?php
namespace RssGenerator\Repository;

use RssGenerator\Db\ConnectionFactory as ConnectionFactory;
use RssGenerator\Domain\Type as Type;
use RssGenerator\Util\RepositoryUtils as RepositoryUtils;

class TypeRepository
{
    public static function findByType(string $type): array
    {
        $db = ConnectionFactory::getFactory()->getConnection();
        return $db->select("type", RepositoryUtils::getDomainColumns(Type::class), [
            "type" => $type,
            "enabled" => true,
        ]);
    }
}
