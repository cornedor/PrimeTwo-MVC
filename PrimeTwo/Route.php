<?php

Class Route {
	private static $paramData;


	public function __construct() {
		echo 'construct';
	}

	public static function get($usrRoute, callable $funct) {
		Debug::dd($_SERVER);

		if(self::matchUriToRoute($usrRoute)) {
			'url matched the user route';
		}

		call_user_func($funct, self::$paramData);
	}

	public static function matchUriToRoute($usrRoute) {
		// get and normalize the uri [filter bad stuff]
		$reqUri = self::normalizeUri($_SERVER['REQUEST_URI']);

		// solve regexpr(retrieve possible parameters)
		$solvedRoute = self::solveUserRoute($usrRoute);

		return $uri;
	}

	private static function solveUserRoute($route) {
		
	}

	public static function normalizeUri($uri) {
		// do filtering stuff and remove htmltags/script language
		// and all bad stuff in general that shouldnt be in a uri string
		return $uri;		
	}

}