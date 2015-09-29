<?php
/**
 * PrimeTwo-MVC
 */

// for now manually set debug stuff
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require '../vendor/autoload.php';
require '../config/database.php';
require '../start.php';

// for now manually set debug stuff
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// for now just include some classes
include '../PrimeTwo/Route.php';
include '../PrimeTwo/Debug.php';

echo 'Welcome to PrimeTwo<br/>';

Route::get('/about/{$foo}/{$bar}', function($foo, $bar) {
	echo 'This is the about: '.$foo.' AND '.$bar.' page.';
});

Route::get('/', function() {
	echo 'this is the / route.';
});

Route::get('/about', function() {
	echo 'this is the /about route.';
});

Route::get('/about/{$foo}', function($foo) {
	echo 'this is the about '.$foo.' page.';
});

// this function only works correctly at the bottom of the index
// im not sure how to fix that -peter
Route::notFound(function($uri) {
	echo '404 page with uri: '.$uri.' not found.';
});

echo '<br/>endof index';
