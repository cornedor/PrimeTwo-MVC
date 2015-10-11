<?php
/**
 * Debug.php
 * Created by: Peter
 * Date: 2015/09/29
 * Time: 16:15 CEST
 */

namespace PrimeTwo\Framework;

Class Debug {

    /**
     * Simple dump and die function. Print something & stop doing everything else.
     * @param $data
     */
    public static function dd($data) {
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		die();
	}

    /**
     * Like Debug::dd() but without the die. Keeps application going.
     * @param $data
     */
    public static function d($data) {
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
	}

}