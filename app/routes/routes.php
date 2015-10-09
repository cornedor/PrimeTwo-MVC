<?php

use PrimeTwo\Http\Route as Route;

// Homepage route
Route::get('/', 'index@HomeController');

Route::get('contact', function() {
   ?>
    <form action="/contact" method="POST">
        <input type="text" name="data">
        <input type="submit">
    </form>
<?php
});
Route::post('contact.edit', 'contact@HomeController');

// default to the Homepage route.
Route::notFound('index@HomeController');