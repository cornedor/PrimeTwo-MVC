<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class AddNamePictureFieldsUserTable extends Capsule {

    public function run() {
        Capsule::schema()->table('users', function(Blueprint $table) {
            $table->string('picture');
            $table->string('fullname');
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