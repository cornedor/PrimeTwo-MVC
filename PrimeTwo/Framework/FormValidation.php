<?php
/**
 * Created by PhpStorm.
 * User: peterzen
 * Date: 10/10/15
 * Time: 9:10 PM
 */

namespace PrimeTwo\Framework;


class FormValidation {
    private static $patterns = [
        'name' => '/([A-Za-z ])+/',
        'email' => '/^([\S]+)@{1}([\w-]+)+\.+([a-zA-Z.]){2,20}$/',
        'tel' => '/^\+*[\d\s]+\d$/'
    ];
    private static $patternNames = [
        'name' => 'name',
        'email' => 'email Address',
        'tel' => 'phone Number'
    ];


    /**
     * @param $patternKey
     * @param bool|false $forHtml
     * @return bool|string
     */
    public static function getPattern($patternKey, $forHtml = false) {
        $pattern = (isset(self::$patterns[$patternKey])?self::$patterns[$patternKey]:false);

        if($forHtml)
            $pattern = trim($pattern, '/'); $pattern = rtrim($pattern, '/');

        return $pattern;
    }

    /**
     * @param $inputs
     * @return array|bool
     */
    public static function validate($inputs) {
        $output = array();

        foreach($inputs as $userInput => $validationRules) {
            $testResult = self::testInputToRules($userInput, $validationRules);
            if(is_string($testResult))
                $output[] = $testResult;
        }

        if(!empty($output))
            return $output;

        return true;
    }

    /**
     * @param $userInput
     * @param $validationRules
     * @return bool|string
     */
    private static function testInputToRules($userInput, $validationRules) {
        foreach($validationRules as $validationRule) {
            if($validationRule == 'required' && empty($userInput)) {
                return 'The '.$userInput.' field is required.';
            } elseif(array_key_exists($validationRule, self::$patterns)) {
                if(!preg_match(self::$patterns[$validationRule], $userInput)) {
                    return '&quot;'.$userInput.'&quot; is not a valid value for the '.self::$patternNames[$validationRule].' field.';
                }
            }
        }
        return true; // return true when the input tested correctly to the rules
    }
}