<?php
/**
 * Boot.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 11:20 AM
 */

namespace PrimeTwo\Framework;

use Illuminate\Database\Capsule\Manager as Capsule;
use PrimeTwo\Http\Route;
use PrimeTwo\Http\Session;
use PrimeTwo\Resources\Migrations;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

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
        $this->bootWhoops();
        $this->bootSession();
        $this->bootDatabase();
        $this->bootMigrations();
        $this->bootRoute();
    }

    /**
     * Boot Whoops exception handler
     */
    private function bootWhoops() {
        if(self::$configuration->get('app')['development']) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');

            $whoops = new Run;
            $whoops->pushHandler(new PrettyPageHandler);
            $whoops->register();
        } else {
            error_reporting(0);
            ini_set('display_errors', 'Off');
        }
    }
    
    /**
     * Boot database connection
     */
    private function bootDatabase()
    {
        $capsule = new Capsule();
        $capsule->addConnection(self::$configuration->get('database')['mysql']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

    }

    private function bootMigrations(){
        new Migrations;
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