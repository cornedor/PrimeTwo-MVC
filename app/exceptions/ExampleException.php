<?php

/**
 * Created by PhpStorm.
 * User: peterzen
 * Date: 10/7/15
 * Time: 4:10 PM
 */

use PrimeTwo\Framework\WhoopsException as WhoopsException;

class ExampleException extends WhoopsException {

    public function __construct($string) {
        parent::__construct();
        throw new Exception($string);
    }

}