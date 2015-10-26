<?php
namespace Models\Doctrine;

use Models\Config\Config;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager as EM;

/**
 * The Doctrine Entity Manager
 *
 * User: Mark Cheptea
 * Date: 10/26/2015
 * Time: 10:07 AM
 */
class EntityManager
{
    private static $instance;
    private static $isDevMode = false;
    private static $metadataDirectory = "../app/storage/doctrine";
    private static $connection = array(
        "host" => "",
        "user" => "",
        "password" => "",
        "dbname"  => "",
        "driver" => "pdo_mysql",
        "charset" => "utf8"
    );

    public static function getEM(){
        if(self::$instance instanceof EM)
            return self::$instance;
        else {
            self::$instance = self::createEntityManager();
        }

        return self::$instance;
    }

    private static function createEntityManager(){
        $config = Setup::createAnnotationMetadataConfiguration(array(self::$metadataDirectory), self::$isDevMode);

        self::$connection['user'] = Config::get("database.mysql.username");
        self::$connection['password'] = Config::get("database.mysql.password");
        self::$connection['dbname'] = Config::get("database.mysql.database");

        return EM::create(self::$connection, $config);
    }
}