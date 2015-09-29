<?php
/**
 * Session.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 12:07 PM
 */

namespace PrimeTwo\Http;


class Session {

    /**
     * Initialize the user session
     */
    public static function init(){
        session_start();
    }

    /**
     * Set a session key with its value
     *
     * @param $key
     * @param $value
     */
    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    /**
     * Get a value from current session with a key
     *
     * @param $key
     * @return mixed
     */
    public static function get($key){
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        return false;
    }

    /**
     * Destroy the user session
     */
    public static function destroy(){
        session_destroy();
    }
}