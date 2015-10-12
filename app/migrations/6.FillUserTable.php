<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class FillUserTable extends Capsule {

    public function run() {
        User::create([
           'username' => 'chameleon',
           'password' => 'habbo123',
           'role_id' => '0',
           'picture' => '/img/koen.jpg',
           'fullname' => 'Koen Hendriks',
        ]);

        User::create([
            'username' => 'peterzen',
            'password' => 'habbo123',
            'role_id' => '0',
            'picture' => '/img/peter.jpg',
            'fullname' => 'Peter Schriever',
        ]);
    }


}