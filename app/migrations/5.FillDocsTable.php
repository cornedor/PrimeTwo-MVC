<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class FillDocsTable extends Capsule {

    public function run() {
        Docs::create([
                'title' => 'Installation',
                'text' => 'Installation instructions unclear, got dick stuck in ventilator.',
                'order' => 0,
            ]
        );

        Docs::create([
                'title' => 'Get Started',
                'text' => 'Git started already chump! Just do it! Make your dreams come true!',
                'order' => 1,
            ]
        );

        Docs::create([
                'title' => 'To be continued',
                'text' => 'Be sure to tune in the next time so you dont miss anything!',
                'order' => 2,
            ]
        );
    }


}