<?php

Class Debug {
	
	public function __construct() {

	}

	public static function dd($data) {
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		die();
	}

	public static function d($data) {
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
	}

}