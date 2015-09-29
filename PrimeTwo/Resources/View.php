<?php
/**
 * Views.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 1:26 PM
 */

namespace PrimeTwo\Resources;


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

        if(is_file(ROOT.'app/views/'.$name.'.php')){
            include ROOT.'app/views/'.$name.'.php';
            return true;
        }elseif(is_file(ROOT.'app/views/'.ucfirst($name.'.php'))){
            include ROOT.'app/views/'.ucfirst($name).'.php';
            return true;
        }elseif(is_file(ROOT.'app/views/'.strtolower($name.'.php'))){
            include ROOT.'app/views/'.strtolower($name).'.php';
            return true;
        }

        return false;
    }
}