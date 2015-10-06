<?php

use PrimeTwo\Framework\Boot as Boot;


define('ROOT',__DIR__.'/');
spl_autoload_register('PrimeTwo\Framework\Boot::loader');
new Boot;

include ROOT.'app/migrations/example-migration.php';;

$create = new CreateContactTable();
$create->run();