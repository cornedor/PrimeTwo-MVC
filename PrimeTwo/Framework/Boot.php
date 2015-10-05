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
    public $configuration;

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
        $capsule->addConnection($this->configuration->get('database'));
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
        $this->configuration = new Configuration();
    }

    /**
     * Boot Sessions
     */
    private function bootSession()
    {
        Session::init();
    }

    public static function loader($name){

    }



}