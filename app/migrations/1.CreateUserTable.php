<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class CreateUserTable extends Capsule {

    public function run() {
        Capsule::schema()->create('users', function($table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            // TODO: add picture & fullname columns
            $table->integer('role_id');
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
        Capsule::schema()->drop('users');
    }

}