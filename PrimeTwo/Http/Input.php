<?php
/**
 * Created by PhpStorm.
 * User: peterzen
 * Date: 10/2/15
 * Time: 2:14 PM
 */

namespace PrimeTwo\Http;



class Input
{
    protected static $all;

    public static function all() {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST))
            $data = $_POST;
        if($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET))
            $data = $_GET;
        if(empty($data)) {
            //TODO: why does this only return a string dump?? - fix
            throw new \Exception("No Input data was found. Check Post and Get");
        }

        self::$all = self::normalizeInputData($data);

        return self::$all;
    }

    public static function get($key) {
        if(empty(self::$all))
            self::all();

        if(array_key_exists($key, self::$all))
            return self::$all[$key];

        return false;
    }

    private static function normalizeInputData($data) {
        // loop through array
        foreach($data as $k => &$v) {
            // remove xss potential
            $v = htmlspecialchars($v);

            $newKey = htmlspecialchars($k);
            if($newKey !== $k) {
                $data[$newKey] = $v;
                unset($data[$k]);
            }
        }
        return $data;
    }


}