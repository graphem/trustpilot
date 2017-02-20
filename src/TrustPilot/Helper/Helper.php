<?php

/*
 * This file is part of the TrustPilot library.
 *
 * (c) Guillaume Bourdages <info@graphem.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TrustPilot\Helper;

/**
 * @author Guillaume Bourdages <info@graphem.ca>
 */

/**
* Helper Class
*/
class Helper 
{
    public static function cleanArray($array){
        foreach ($array as &$value){
            if (is_array($value)){
                $value = self::cleanArray($value);
            }
        }
        return array_filter($array);
    }

    /**
     * @param array $parameters
     */
    protected function build(array $parameters)
    {
        foreach ($parameters as $property => $value) {
            $property = static::convertToCamelCase($property);
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    /**
     * @param string $str Snake case string
     *
     * @return string Camel case string
     */
    protected static function convertToCamelCase($str)
    {
        $callback = function ($match) {
            return strtoupper($match[2]);
        };
        return lcfirst(preg_replace_callback('/(^|_)([a-z])/', $callback, $str));
    }
}