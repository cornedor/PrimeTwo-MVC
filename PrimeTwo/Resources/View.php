<?php
/**
 * Views.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 1:26 PM
 */

use PrimeTwo\Framework\File as File;

abstract class View
{
    public $parameters;

    /**
     * Render a view
     *
     * @param $name
     * @return bool
     */
    public static function render($name)
    {

        $path = ROOT.'app/views/';


        if(File::stringToFile($name, $path))
            include File::stringToFile($name, $path);
        else
            //TODO: throw errors


        return false;
    }
}