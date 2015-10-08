<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class CreatePonyTable extends Capsule {

    public function run() {
        Capsule::schema()->create('ponies', function($table) {
            $table->increments('id');
            $table->string('ponyname');
            $table->integer('ponyswaglevel');
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
        Capsule::schema()->drop('ponies');
    }

}