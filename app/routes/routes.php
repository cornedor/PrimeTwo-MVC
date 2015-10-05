<?php

use PrimeTwo\Http\Route as Route;

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

Route::get('/render', function(){
    View::render('layouts.main');
});

// this function only works correctly at the bottom of the index
// im not sure how to fix that -peter
Route::notFound(function($uri) {
    echo '404 page with uri: '.$uri.' not found.';
});