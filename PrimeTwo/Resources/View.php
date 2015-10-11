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
    private static $layout;
    private static $layoutParams;

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
     * @param bool $skipLayout
     * @return bool
     * @throws Exception
     */
    public static function render($name, $parameters = array(), $skipLayout = false)
    {
        if(!self::$initialized)
            self::$initialized = true;

        $path = ROOT.'app/views/';
        $contentView = File::stringToFile($name, $path);

        if($contentView) {
            if(is_array($parameters))
                extract($parameters);

            if(is_array(self::$layoutParams))
                extract(self::$layoutParams);

            if($skipLayout) {
                // Skip including the layout
                include $contentView;
            } elseif(!empty(self::$layout)) {
                // Include layout file, layout file will have access to the extracted params and $contentView
                include self::$layout;
            } else {
                // Simply include a view without layout.
                include $contentView;
            }

//            if(is_array($parameters))
//                extract($parameters);
//            include File::stringToFile($name, $path);
        } else
            throw new Exception("View file: ".$name." not found in path: ".$path);
    }

    /**
     * @param $name
     * @param array $parameters
     * @throws Exception
     */
    public static function layout($name, $parameters = array()) {
        if(!self::$initialized)
            self::$initialized = true;

        $path = ROOT.'app/views/';

        if(File::stringToFile($name, $path)){
            if(is_array($parameters))
                self::$layoutParams = $parameters;
            self::$layout = File::stringToFile($name, $path);
        } else
            throw new Exception("Layout file: ".$name." not found in path: ".$path);
    }
}