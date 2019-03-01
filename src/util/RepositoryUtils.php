<?php
namespace RssGenerator\Util;

class RepositoryUtils
{
    public static function getDomainColumns($class, $prefix = null, $addDot = true): array
    {
        $columns = array_keys(get_class_vars($class));

        if ($prefix != null) {
            foreach ($columns as &$column) {
                $column = $addDot ? $prefix . "." . $column : $prefix . $column;
            }
        }

        return $columns;
    }
}
