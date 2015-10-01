<?php
/**
 * Views.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 1:26 PM
 */

namespace PrimeTwo\Resources;

use PrimeTwo\Framework\Debug;
use PrimeTwo\Framework\File as File;

class View
{
    public $parameters;

    /**
     * Render a view
     *
     * @param $name
     * @return bool
     */
    static function render($name)
    {

        $path = ROOT.'app/views/';

        if(File::stringToFile($name, $path, '.php'))
            include File::stringToFile($name, $path, '.php');

        return false;
    }
}