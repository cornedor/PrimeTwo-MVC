<?php

use PrimeTwo\Http\Route as Route;

// Homepage route
Route::get('/', 'index@HomeController');

Route::get('documentation', 'documentation@HomeController');
Route::get('about', 'about@HomeController');
Route::get('contact', 'contact@HomeController');
Route::get('contact/{$status}/{$message}', 'contact@HomeController');

Route::post('sendContactMail', 'sendContactMail@HomeController');





// default to the Homepage route.
Route::notFound('index@HomeController');