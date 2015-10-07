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
        $this->bootWhoops();
        $this->bootConfiguration();
        $this->bootSession();
        $this->bootDatabase();
        $this->bootRoute();
    }

    /**
     * Boot Whoops exception handler
     */
    private function bootWhoops() {
        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
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
        $file = ROOT.str_replace('\\','/', $app['Facades'][$name].'.php');
        if(file_exists($file))
            include_once($file);
    }



}