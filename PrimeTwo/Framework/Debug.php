<?php
/**
 * Debug.php
 * Created by: Peter
 * Date: 2015/09/29
 * Time: 16:15 CEST
 */

namespace PrimeTwo\Framework;

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