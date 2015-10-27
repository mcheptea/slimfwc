<?php
namespace Models\Config;

use Piwik\Ini\IniReader;
use Piwik\Ini\IniWriter;

/**
 * The Config class offers access to the application's configurations.
 *
 * User: Mark Cheptea
 * Date: 10/23/2015
 * Time: 11:41 AM
 */
class Config
{
    /**
     * Returns the value of a key. The path is separated by dots (.)
     *
     * @param string $keyString, Key Syntax: [filename].[arraykey1].[arraykey2]...[arraykeyN]
     * @return mixed
     * @throws Exception
     */
    public static function get($keyString = "")
    {
        $keys = explode(".", $keyString);

        $configFileName = __DIR__ . "/../../config/".array_shift($keys).".ini";

        if(!file_exists($configFileName)){
            throw new Exception("No configuration file named ". $configFileName . " exists.");
        }

        //$configArray = parse_ini_file($configFileName, true);

        $reader = new IniReader();
        $configArray = $reader->readFile($configFileName);

        return self::getArrayValueByPath($keys, $configArray);
    }

    /**
     * Writes a value to the ini file. The path is separated by dots (.)
     *
     * @param string $keyString, Key Syntax: [filename].[arraykey1].[arraykey2]...[arraykeyN]
     * @param mixed $value
     * @return mixed
     * @throws Exception
     */
    public static function set($keyString = "", $value = "")
    {
        $keys = explode(".", $keyString);

        $configFileName = __DIR__ . "/../../config/".array_shift($keys).".ini";

        if(!file_exists($configFileName)){
            throw new Exception("No configuration file named ". $configFileName . " exists.");
        }

        $reader = new IniReader();
        $configArray = $reader->readFile($configFileName);

        //set value
        self::setArrayValueByPath($configArray, $keys, $value);

        $writer = new IniWriter();
        $writer->writeToFile($configFileName, $configArray);
    }

    /**
     * Returns a value from an array given a path to it.
     *
     * @param array $path, a set of keys identifying the value
     * @param array $array, the storing array
     * @return mixed
     */
    private static function getArrayValueByPath($path, $array)
    {
        if(count($path) > 1)
            return self::getArrayValueByPath(array_slice($path, 1), $array[$path[0]]);
        else
            return $array[$path[0]];
    }

    /**
     * @param array $array, destination
     * @param array $pathParts, path
     * @param mixed $value, value
     * @return array
     */
    private static function setArrayValueByPath(&$array, $pathParts, &$value) {
        $current = &$array;
        foreach($pathParts as $key) {
            $current = &$current[$key];
        }

        $backup = $current;
        $current = $value;

        return $backup;
    }
}