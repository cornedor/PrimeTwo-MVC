<?php
/**
 * Route.php
 * Created by: Peter
 * Date: 2015/09/29
 * Time: 16:15 CEST
 */

namespace PrimeTwo\Http;

use PrimeTwo\Framework\Debug as Debug;

class Route {
	// Class properties
	
	private static $paramData;
	private static $match = false;

	// Public functions

	/**
	 * This is usually called as a last resort and will most likely return some kind of 404 page
	 * @param callable $function	A callback function with by default the request uri.
	 * @return bool|mixed			Either the results of the callback or false is returned.
	 */
	public static function notFound(callable $function) {
		if(self::$match) {
			return false;
		}
		return call_user_func($function, $_SERVER['REQUEST_URI']);
	}

	/**
	 * Try to match an application route with the current request uri
	 * @param  string   $appRoute 		Application route to match
	 * @param  callable $function    	A callback function, for code execution when route matches.
	 * @return bool|mixed   			Either the results of the callback or false is returned.
	 */
	public static function get($appRoute, callable $function) {
		if(self::$match) {
			// a match has already been determined, return false on all other attempts
			return false;
		}

		// check if the url and uri match
		if(self::matchUriToRoute($appRoute)) {
			Debug::d(self::$paramData);
			return call_user_func_array($function, self::$paramData);
		}
		return false;
	}

	// Private functions
	
	/**
	 * Check if an application route matches the current REQUEST_URI.
	 * @param  string $appRoute		Application route string to test.
	 * @return bool            		Returns either true or false.
	 */
	private static function matchUriToRoute($appRoute) {
		// get and normalize the uri [filter bad stuff]
		$requestUri = self::normalizeUri($_SERVER['REQUEST_URI']);

		// explode for looping
		$arrRequestUri = explode('/', $requestUri);
		$appRoute = explode('/', $appRoute);

		/*echo '<br/>requestUri<br/>';
		Debug::d($arrRequestUri);
		echo 'appRoute<br/>';
		Debug::d($appRoute);*/

		$matches = 0;
		foreach ($arrRequestUri as $k => $v) {
			if(!isset($appRoute[$k])) {
				// no route entry for matching available
				// no entry == mismatch
				$matches = 0;
				break; // breaks out of foreach!
			} elseif($appRoute[$k] == $v) {
				// route and uri match
				$matches++;
			} elseif(self::variableMatchTest($appRoute[$k], $v)) {
				// parameter match
				$matches++;
				// other option:
				// instead of $k use $appRoute[$k] which results in {$foo} = $v
				self::$paramData[$k] = $v;
			} else {
				// 1 mismatch == no match
				$matches = 0;
				break; // breaks out of foreach!
			}
		}
		
		if($matches == count($appRoute) && $matches == count($arrRequestUri)) {
			self::$match = true;
			return true;
		}
		return false;
	}

	/**
	 * Check if a part of the application route and a part of the request uri match.
	 * Basicly to find parameter/argument data in the request uri.
	 * @param  string $routePart 	A part of the exploded application route. Has to have the same key as $uriPart.
	 * @param  string $uriPart   	A part of the exploded request uri. Has to have the same key as $routePart.
	 * @return bool             	Return either true or false depending on validity and compatibility.
	 */
	private static function variableMatchTest($routePart, $uriPart) {
		if(preg_match('/{[$a-zA-Z]*}/', $routePart)) {
			// routePart is looking for a variable
			if(preg_match('/[a-zA-Z0-9]*/', $uriPart)) {
				// uriPart is compatible
				return true;
			}
		}
		return false;
	}

	/**
	 * Normalize the request uri
	 * @param  string $uri The $_SERVER['REQUEST_URI'] string.
	 * @return string      Normalized or 'clean' version of the uri.
	 */
	public static function normalizeUri($uri) {
		// do filtering stuff and remove htmltags/script language
		// and all bad stuff in general that shouldnt be in an uri string
		return $uri;
	}

}