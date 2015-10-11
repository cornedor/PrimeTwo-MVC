<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateDocsTable extends Capsule {

    public function run() {
        Capsule::schema()->create('docs', function($table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('text');
            $table->integer('order');
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
        Capsule::schema()->drop('docs');
    }

}