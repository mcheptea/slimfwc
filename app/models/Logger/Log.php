<?php
namespace Models\Logger;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Models\Config\Config;

/**
 * The Log class
 *
 * User: Mark Cheptea
 * Date: 10/26/2015
 * Time: 12:55 PM
 */
class Log
{
    private static $log;

    /**
     * Log levels from monolog (incomplete)
     *  100 => 'debug'
     *  200 => 'info'
     *  300 => 'warning'
     *  400 => 'error'
     *  550 => 'alert'
     * @var string
     */
    private static $level;

    private static function getLogger(){
        if(self::$log instanceof Logger){
            return self::$log;
        }
        else {
            self::$level = Logger::toMonologLevel(Config::get("log.file.level"));
            self::$log = new Logger('SlimLogger');
            self::$log->pushHandler(new StreamHandler(Config::get("log.file.path"), self::$level));
        }

        return self::$log;
    }

    public static function addDebug($message = ""){
        $log = self::getLogger();
        $log->addDebug($message);
    }

    public static function addInfo($message = ""){
        $log = self::getLogger();
        $log->addInfo($message);
    }

    public static function addWarning($message = ""){
        $log = self::getLogger();
        $log->addWarning($message);
    }

    public static function addError($message = ""){
        $log = self::getLogger();
        $log->addError($message);
    }

    public static function addAlert($message = ""){
        $log = self::getLogger();
        $log->addAlert($message);
    }
}