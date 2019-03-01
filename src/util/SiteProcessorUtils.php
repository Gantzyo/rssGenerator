<?php
namespace RssGenerator\Util;

use RssGenerator\Domain\Cookie as Cookie;

class SiteProcessorUtils
{
    /**
     * @param Cookie[] $cookies
     * @return ?string
     */
    public static function getCookiesAsString($cookies): ?string
    {
        $cookiesString = null;
        for ($i = 0; $i < count($cookies); $i++) {
            $cookie = $cookies[$i];

            if ($i > 0) {
                $cookiesString .= "; ";
            }

            $cookiesString .= $cookie->name . "=" . $cookie->value;
        }
        // Returned string format:
        // key1=value1; key2=value2; key3=value3
        return $cookiesString;
    }

        /**
     * @param string $html
     * @return string
     */
    public static function getHtmlWithoutScripts(string $html): string
    {
        return preg_replace("/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i", "", $html);
    }
}
