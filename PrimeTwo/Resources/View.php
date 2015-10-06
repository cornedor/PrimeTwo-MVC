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
     * @param array $parameters
     * @return bool
     */
    public static function render($name, $parameters = array())
    {
        if(!self::$initialized)
            self::$initialized = true;

        $path = ROOT.'app/views/';

        if(File::stringToFile($name, $path)){
            if(is_array($parameters))
                extract($parameters);
            include File::stringToFile($name, $path);
        } else
            //TODO: throw errors


        return false;
    }
}