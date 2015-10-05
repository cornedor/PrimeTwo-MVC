<?php

use PrimeTwo\Framework\Debug;
use PrimeTwo\Http\Input;
use PrimeTwo\Http\Route as Route;

Route::get('about/{$foo}/{$bar}', function($foo, $bar) {
    echo 'This is the about: '.$foo.' AND '.$bar.' page.';
});

Route::get('/', function() {
    echo 'this is the / route.';
});

Route::get('about', function() {
    echo 'this is the about route.';
});

Route::get('about/{$foo}', function($foo) {
    echo 'this is the about '.$foo.' page.';
});

Route::get('/render', function(){
   View::render('layouts.main');
});

Route::get('/post', function() {
    ?>
    <form method="POST" action="/post">
        <label for="textInput">textInput:</label><input id="textInput" type="text" name="textInput"><br/>
        <label for="submit">submit:</label><input id="submit" type="submit" name="submit"><br/>
    </form>
    <?php
});

Route::post('/post', function() {
    // postdata wordt niet meer doorgestuurd als parameters
    // nu beschikbaar via Input class :)
    Debug::d(Input::all());
});

// binding a route to a method examples
Route::get('/contact', 'index@ContactController');
Route::get('/contact/edit', 'edit@ContactController'); // dunno why you would want this but hey im just testing stuff
Route::get('/contact/edit/{$contactid}', 'edit@ContactController');
Route::post('/contact/update/{$contactId}', 'update@ContactController');
Route::post('/contact/update', 'update@ContactController');



// this function only works correctly at the bottom of the index
// im not sure how to fix that -peter
Route::notFound(function($uri) {
    echo '404 page with uri: '.$uri.' not found.';
});
