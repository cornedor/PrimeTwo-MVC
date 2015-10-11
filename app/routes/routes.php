<?php

use PrimeTwo\Http\Route as Route;

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