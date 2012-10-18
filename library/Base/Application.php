<?php

/**
 * Class Base_Application
 *
 * @package ThinkFW
 * @subpackage Base
 * @author Willem Daems
 *
 */
class Base_Application
{
    /**
     * Holds the database object
     * @var Abstract_Database_Database
     */
    public static $database;

    /**
     * random salt
     *
     * @var string
     */
    public static $rand = 'thfw@sadg80!!';

    /**
     * Set the database
     *
     * @param Abstract_Database_Database $daoObject
     * @return void;
     */
    public static function setDatabase(Abstract_Database_Database $daoObject)
    {
        self::$database = $daoObject;
    }

    /**
     *
     * Gets the current database used for the application
     *
     * @return Abstract_Database_Database
     */
    public static function getDatabase()
    {
        return self::$database;
    }

    /**
     * Salt a password with two string
     *
     * @param string $string1
     * @param string $string2
     * @return string
     */
    public static function salt($string1, $string2)
    {
        return md5($string1 . $string2 . self::$rand);
    }

    /**
     * redirect
     *
     * Changes the current location
     *
     * @param type $location
     * @return void
     */
    public static function redirect($location)
    {
        try {
            header("Location: " . $location);
            exit;
        } catch (Exception $e) {

        }
    }
}