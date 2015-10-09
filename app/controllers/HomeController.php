<?php
/**
 * Created by PhpStorm.
 * User: peterzen
 * Date: 10/8/15
 * Time: 1:53 PM
 */

use PrimeTwo\Resources\Controller;

class HomeController extends Controller
{

    public function index() {
        View::render('layouts.main', ['contentView' =>'home.index']);
    }

    public function contact() {
        View::render('layouts.main');
    }
}