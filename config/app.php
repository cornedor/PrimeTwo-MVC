<?php

// TODO: talk about this. the reason i do this is to use the APP_URL in views
define('APP_URL', 'http://primetwo.dev');

return array(

    'name' => 'PrimeTwo Demo App',
    'url' => 'http://primetwo.dev',
    'email' => 'info@primetwo.nl',

    'development' => true,

    // Facades for including classes with static functions ( like render )
    'Facades' => array(
        'View' => 'PrimeTwo\Resources\View',
        //'FormValidation' => 'PrimeTwo\Framework\FormValidation' TODO: hoe werkt dit eigenlijk @Koen ?
    )
);
