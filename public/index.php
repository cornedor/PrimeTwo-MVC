<?php
/**
 * 	PrimeTwo PHP Framework
 */

// for now manually set debug stuff
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// for now just include some classes
include '../PrimeTwo/Route.php';
include '../PrimeTwo/Debug.php';

echo 'Welcome to PrimeTwo';

Route::get('/', function() {
	echo 'this is the / route.';
});

Route::get('/about/$var', function($var) {
	echo 'this is the / route.';
});

echo 'endof index';