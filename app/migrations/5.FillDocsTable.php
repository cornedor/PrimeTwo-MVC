<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class FillDocsTable extends Capsule {

    public function run() {
       Docs::query(file_get_contents(ROOT.'demo_docs.sql'));
    }


}