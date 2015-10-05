<?php
/**
 * File.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 9:41 PM
 */

namespace PrimeTwo\Framework;


class File
{
    /**
     * String to file function to use names like layout.main
     *
     * @param $string
     * @param string $prefix
     * @param string $extension
     * @return bool|string
     */
    public static function stringToFile($string, $prefix = '', $extension = '.php'){

        $path = str_replace('.','/',$string);
        $file = rtrim($prefix,'/') . '/' . trim($path, '/') . $extension;

        if(is_file($file))
            return $file;

        return false;
    }
}