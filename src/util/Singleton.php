<?php

namespace RssGenerator\Util;

// https://stackoverflow.com/a/37800033
/**
 * Singleton Pattern.
 *
 * Modern implementation.
 */
abstract class Singleton
{
    /**
     * Call this method to get singleton
     */
    public static function instance()
    {
        static $instance = false;
        if ($instance === false) {
            // Late static binding (PHP 5.3+)
            $instance = new static();
        }

        return $instance;
    }

}
