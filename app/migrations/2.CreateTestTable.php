<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTestTable extends Capsule {

    public function run() {
        Capsule::schema()->create('tests', function($table) {
            $table->increments('id');
            $table->string('tests');
            $table->integer('number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->drop('tests');
    }

}