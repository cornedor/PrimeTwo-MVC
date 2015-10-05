<?php

use PrimeTwo\Framework\Boot as Boot;

define('ROOT',__DIR__.'/');
require_once(ROOT.'PrimeTwo/Resources/View.php');

spl_autoload_register('PrimeTwo\Framework\Boot::loader');
new Boot;
