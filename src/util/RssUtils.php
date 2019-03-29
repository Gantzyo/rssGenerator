<?php

namespace RssGenerator\Util;

class RssUtils
{
    public static function timestampToRFC822(string $timestamp, string $format = "Y-m-d H:i:s"): string
    {
        // return DateTime::createFromFormat($format, $timestamp)->format(DateTimeInterface::RFC822); // Versatile workaround
        return \date("r", \strtotime($timestamp));
    }
    public static function curPageURL(): string
    {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}
