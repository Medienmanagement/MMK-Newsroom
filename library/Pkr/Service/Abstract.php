<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

abstract class Pkr_Service_Abstract
{
    /**
     * @var \Zend_Cache_Core
     */
    protected static $_cache = null;

    /**
     * @var \Zend_Log
     */
    protected static $_log = null;

    public static function getCache()
    {
        return self::$_cache;
    }

    public static function getLog()
    {
        return self::$_log;
    }

    public static function setCache(\Zend_Cache_Core $cache)
    {
        self::$_cache = $cache;
    }

    public static function setLog(\Zend_Log $log)
    {
        self::$_log = $log;
    }
}

class Pkr_Service_Abstract_Exception extends \Exception
{
}
