<?php
/**
 * Migrations.php
 * Created by: koen
 * Date: 10/7/15
 * Time: 7:20 PM
 */

namespace PrimeTwo\Resources;


use PDOException;
use PrimeTwo\Framework\Model\Migration;
use PrimeTwo\Framework\Migrations\CreateMigrationTable;

class Migrations
{
    private $batch = 1; // TODO add migrations batches for roll bakcs
    public $migrations = array();

    /**
     * Constructor for migrations. Checks if migration table exists and runs migrations from the user app folder
     *
     * @throws \Exception
     */
    public function __construct(){
        try {
            Migration::query('SELECT * FROM `migrations`')->get();
        } catch (PDOException $e){
            if($e->getCode() == '42S02') {
                //Migration table not found, so we need to run the migration
                CreateMigrationTable::run();
            } else {
                // Still throw the original PDOException for when (for example) the database connection failed
                throw $e;
            }
        }

        // TODO create migrations CLI, add migrations table to database to check double migrations
        $this->find();
        $this->run();
    }

    private function find()
    {
        $files = preg_grep('/^([^.])/', scandir(ROOT.'app/migrations'));
        foreach ($files as $file)
            $this->pushMigrations($file);
    }

    private function run(){
        foreach($this->migrations as $migration){
            $migrationExists = Migration::where('migration', $migration)->first();

            if(is_null($migrationExists)){

                if(class_exists($migration)){

                    $migrator = new $migration;
                    if(method_exists($migrator, 'run')) {
                        $migrator->{'run'}();
                        Migration::create(['migration' => $migration, 'batch' => 3]);
                    }else {
                        throw new \Exception('Migration '.$migration.' does not have a run method.');
                    }

                }else{
                    throw new \Exception('Class '. $migration.' does not exists in Migrations.');
                }
            }
        }
    }

    /**
     * Push migration files into the migrations array
     * @param $file
     * @return array with migrations
     * @throws \Exception if migration has an invalid name
     */
    private function pushMigrations($file)
    {
        $split = explode('.',$file);

        if(count($split) < 2 || !is_numeric($split[0]))
            throw new \Exception($file.'is an invalid migration filename.');

        $order = $split[0];
        $migration = $split[1];

        $this->migrations[$order] = $migration;

        //Manual load the class
        include(ROOT.'app/migrations/'.$file);
    }

    /**
     * @return array with migrations
     */
    public function getMigrations()
    {
        return $this->migrations;
    }
}