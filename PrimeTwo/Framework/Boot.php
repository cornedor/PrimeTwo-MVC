<?php
/**
 * Boot.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 11:20 AM
 */

namespace PrimeTwo\Framework;

use Illuminate\Database\Capsule\Manager as Capsule;

use PrimeTwo\Http\Route as Route;
use PrimeTwo\Http\Session;

/**
 * Class Boot
 *
 * Boots the default logic like database, routing, connections etc.
 *
 * @package PrimeTwo
 */
class Boot
{
    /**
     * @var configuration file loaded by Configuration class
     */
    public static $configuration;

    public function __construct()
    {
        $this->bootConfiguration();
        $this->bootSession();
        $this->bootDatabase();
        $this->bootRoute();
    }

    /**
     * Boot database connection
     */
    private function bootDatabase()
    {
        $capsule = new Capsule();
        $capsule->addConnection(self::$configuration->get('database')['mysql']); //TODO make config dynamic driver
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

    }

    /**
     * Boot routing
     */
    private function bootRoute()
    {
        new Route;
    }

    /**
     * Boot configuration
     */
    private function bootConfiguration()
    {
        self::$configuration = new Configuration();
    }

    /**
     * Boot Sessions
     */
    private function bootSession()
    {
        Session::init();
    }

    public static function loader($name){
        $app = self::$configuration->get('app');
        //TODO create facades class with exceptions
        if(array_key_exists($name,$app['Facades'])){
            $file = ROOT.str_replace('\\','/', $app['Facades'][$name].'.php');
            if(file_exists($file))
                include_once($file);
        }
    }



}