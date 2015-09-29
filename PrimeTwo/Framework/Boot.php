<?php
/**
 * Boot.php
 * Created by: koen
 * Date: 9/29/15
 * Time: 11:20 AM
 */

namespace PrimeTwo\Framework;

use Illuminate\Database\Capsule\Manager as Capsule;
use PrimeTwo\Http\Routing as Routing;
use PrimeTwo\Framework\Configuration as Configuration;

/**
 * Class Boot
 *
 * Boots the default logic like database, routing, connections etc.
 *
 * @package PrimeTwo
 */
class Boot
{
    public $configuration;

    public function __construct()
    {
        $this->bootConfiguration();
        $this->bootDatabase();
        $this->bootRouting();
    }

    /**
     * Boot databse connection
     */
    private function bootDatabase()
    {
        $capsule = new Capsule();
        $capsule->addConnection($this->configuration->get('database'));
        $capsule->bootEloquent();
    }

    private function bootRouting()
    {
        new Routing;
    }

    private function bootConfiguration()
    {
        $this->configuration = new Configuration();
    }
}