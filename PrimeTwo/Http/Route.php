<?php
/**
 * Route.php
 * Created by: Peter
 * Date: 2015/09/29
 * Time: 16:15 CEST
 */

namespace PrimeTwo\Http;



class Route {
	// Class properties
	
	private static $paramData;
	private static $match = false;

	// Public functions

	// include/read route files
    public function __construct() {
		$files = preg_grep('/^([^.])/', scandir(ROOT.'app/routes/'));
		foreach($files as $file)
			include ROOT.'app/routes/'.$file;
	}

	/**
	 * This is usually called as a last resort and will most likely return some kind of 404 page
	 * @param callable $callback	A callback function with by default the request uri.
	 * @return bool|mixed			Either the results of the callback or false is returned.
	 */
	public static function notFound($callback) {
		if(self::$match) {
			return false;
		}

        self::$match = true;
        return call_user_func($callback, $_SERVER['REQUEST_URI']);
	}

    /**
     * Try to match an application route with the current request uri and post request method
     * @param $appRoute
     * @param $callback
     * @return bool|mixed
     */
    public static function post($appRoute, $callback) {
        $appRoute = self::normalizeRoute($appRoute);
        if(self::matchUriToRoute($appRoute, "POST")) {
            // for now just add the $_POST variable
            // 2015-10-02: disabled this so u can use uri parameters
            //self::$paramData = $_POST;
            self::$match = true;

            return self::runCallback($callback);
            //return call_user_func_array($callback, $_POST);
        }
        return false;
    }

    /**
	 * Try to match an application route with the current request uri and get request method
	 * @param  string   $appRoute 		Application route to match
	 * @param  callable $callback    	A callback function, for code execution when route matches.
	 * @return bool|mixed   			Either the results of the callback or false is returned.
	 */
	public static function get($appRoute, $callback) {
        $appRoute = self::normalizeRoute($appRoute);
        // check if the url and uri match and extract uri parameters
        if(self::matchUriToRoute($appRoute, "GET")) {
            return self::runCallback($callback);
		}
		return false;
	}

    // Private functions

    /**
     * Do magic with slashes and trim. Normalize the users route string.
     * @param $route
     * @return string
     */
    private static function normalizeRoute($route) {
        $route = str_replace('.','/',$route);
        return '/'.trim($route, '/');
    }

    /**
     * Run either a class::method for strings or run call_user_func for function callbacks
     * @param $callback
     * @return bool|mixed
     */
    private static function runCallback($callback) {
        // check if it is a callable/function
        if(is_callable($callback)) {
            self::$match = true;
            if(!empty(self::$paramData)) {
                return call_user_func_array($callback, self::$paramData);
            } else {
                return call_user_func($callback);
            }
        }
        // check if it is a controller string
        if(is_string($callback)) {
            $pattern = '/[a-zA-Z]*@[a-zA-Z]*/';
            if(preg_match($pattern, $callback)) {
                $arrCallback = explode("@", $callback);
                $class = new $arrCallback[1]();
                if(!empty(self::$paramData))
                    $result = call_user_func_array([$class,$arrCallback[0]], self::$paramData);
                else
                    $result = $class->$arrCallback[0]();

                self::$match = true;
                echo $result;
            } else {
                // doesn't match method@controller pattern
                throw new \Exception("method@controller pair not found in: ".$callback);
            }
        } else
            throw new \Exception("callback was not callable or a string: ".$callback);
    }

    /**
	 * Check if an application route matches the current REQUEST_URI.
	 * @param  string $appRoute		    Application route string to test.
     * @param  string $requestMethod    Optionally test if the request methods match. Defaults to GET
	 * @return bool            		Returns either true or false.
	 */
	private static function matchUriToRoute($appRoute, $requestMethod = "GET") {
        if(self::$match) {
            // a match has already been determined, return false on all other attempts
            return false;
        }

        // test request method
        if($_SERVER['REQUEST_METHOD'] !== $requestMethod) {
            return false;
        }

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
        // TODO: would like to cleanup this foreach and test against conditions in a 'cleaner' way.
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
	// TODO: add custom preg_match support
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
        $uri = htmlentities($uri);
		return $uri;
	}

}