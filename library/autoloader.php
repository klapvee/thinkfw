<?php

/**
 *  Class AutoLoader
 *  @package ThinkFW
 * @subpackage AutoLoader
 *  @author Willem Daems
 */
class AutoLoader
{
    /**
     * The autoloader for the application
     *
     * @param string $name
     * @return void
     */
    public static function autoload($name)
    {
        if (strpos($name, '_') === false) {
                // getting controller
                require $name . '.php';
        } else {
            if (strpos($name, 'Model') !== false) {
                $file = explode('_', $name);
                require_once APPLICATION_PATH . '/Models/' . $file[count($file) -1] . '.php';
            } else {
                $path = explode('_', $name);
                $file = array_pop($path);
                $dir = implode('/', $path);

                if (self::searchDirectory($dir)) {
                    require_once $file . '.php';
                } else {
                    //echo "WRONG!";
                }
            }
        }
    }

    /**
     * searchDirectory returns true on successfully finding the path
     *
     * @param string $path
     * @param string $file
     * @return boolean
     */
    public static function searchDirectory($path, $file = '')
    {
        $incpath = explode(PATH_SEPARATOR, get_include_path());

        for ($i = 0; $i < count($incpath); $i++)
        {
            if (is_dir($incpath[$i] . '/' . $path)) {
                set_include_path(get_include_path() . PATH_SEPARATOR . $incpath[$i] . '/' . $path. '/');
                return true;
            }

            // also try plurals
            if (is_dir($incpath[$i] . '/' . $path . 's/')) {
                set_include_path(get_include_path() . PATH_SEPARATOR . $incpath[$i] . '/' . $path. 's/');
                return true;
            }
        }

        return false;
    }
}