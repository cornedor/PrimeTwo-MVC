<?php
namespace PrimeTwo\Framework\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateMigrationTable extends Capsule {

    public static function run() {
        Capsule::schema()->create('migrations', function($table) {
            $table->increments('id');
            $table->string('migration');
            $table->integer('batch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public static function down()
    {
        Capsule::schema()->drop('migrations');
    }

}