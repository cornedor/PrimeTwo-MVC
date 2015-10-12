<?php

return array(
    // Application name goes here.
    'name' => 'PrimeTwo MVC Framework',

    // Application url
    'url' => 'http://primetwo.nl',

    // Application email address
    'email' => 'info@primetwo.nl',

    // Is this application in development?
    // Enables error reporting for true.
    'development' => true,

    // Facades for including classes with static functions ( like render )
    'Facades' => array(
        'View' => 'PrimeTwo\Resources\View',
        //'FormValidation' => 'PrimeTwo\Framework\FormValidation' TODO: hoe werkt dit eigenlijk @Koen ?
    )
);
