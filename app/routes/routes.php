<?php

use PrimeTwo\Http\Route as Route;

Route::get('/example',function(){
    echo 'Working route example!';
});

Route::get('/example/{$number}',function($number){
    echo 'Working route '.$number.' example!';
});

// Homepage route
Route::get('/', 'index@HomeController');

// Documentation route
Route::get('documentation', 'documentation@HomeController');

// About us route
Route::get('about', 'about@HomeController');

// Contact routes
Route::get('contact', 'contact@HomeController');
Route::get('contact/{$status}/{$message}', 'contact@HomeController');

// A post route for the contact form data
Route::post('sendContactMail', 'sendContactMail@HomeController');





// default to the Homepage route.
Route::notFound('index@HomeController');