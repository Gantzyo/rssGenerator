<?php
namespace RssGenerator\Service;

use RssGenerator\Domain\Cookie as Cookie;
use RssGenerator\Domain\Site as Site;
use RssGenerator\Repository\CookieRepository as CookieRepository;

class CookieService
{
    /**
     * @return Cookie[]
     */
    public static function getSiteCookies(Site $site)
    {
        $rows = CookieRepository::findByType($site->Type_type);
        return self::getRowsAsCookies($rows);
    }

    /**
     * @return Cookie[]
     */
    private static function getRowsAsCookies(array $rows)
    {
        $cookies = [];
        foreach ($rows as $row) {
            $cookies[] = self::getRowAsCookie($row);
        }
        return $cookies;
    }

    private static function getRowAsCookie(array $row): Cookie
    {
        $cookie = new Cookie();
        foreach ($row as $key => $value) {
            $cookie->{$key} = $value;
        }
        return $cookie;
    }
}
