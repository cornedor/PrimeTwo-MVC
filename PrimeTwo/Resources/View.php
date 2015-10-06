<?php
/**
 * Views.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 1:26 PM
 */

use PrimeTwo\Framework\File as File;

class View
{
    private static $initialized = false;

    /**
     * Initialize static class
     */
    private static function initialize()
    {
        if (self::$initialized)
            return;

        self::$initialized = true;
    }

    /**
     * Render a view
     *
     * @param $name
     * @return bool
     */
    public static function render($name)
    {
        if(!self::$initialized)
            self::$initialized = true;

        $path = ROOT.'app/views/';


        if(File::stringToFile($name, $path))
            include File::stringToFile($name, $path);
        else
            //TODO: throw errors


        return false;
    }
}