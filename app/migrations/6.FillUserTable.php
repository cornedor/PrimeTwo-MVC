<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class FillUserTable extends Capsule {

    public function run() {
       User::query(file_get_contents(ROOT.'demo_users.sql'));
    }


}