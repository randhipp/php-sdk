<?php namespace Moota\SDK;

/**
 * Class Config
 * 
 * A singleton in-memory config storage
 * 
 * @package Moota\SDK
 */
class Config
{
    /** @var string $apiKey */
    public static $apiKey = null;

    /** @var integer|float $apiTimeout */
    public static $apiTimeout = 30;

    /** @var string $sdkMode production or testing */
    public static $sdkMode = 'production';

    /** @var string $serverAddress */
    public static $serverAddress = 'app.moota.co';

    /**
     * Set Config static variable's value from an array
     * 
     * @param  array Associative array of key-value pairs
     * @param  array Errors that might come up
     * 
     * @return bool  Whether there are errors
     */
    public static function fromArray($values, &$errors = null)
    {
        $success = true;

        foreach ($values as $key => $value) {
            $key = camel_case($key);

            if ( self::has($key) ) {
                self::${ $key } = $value;
            } else {
                $errors[] = "`$key` does not exists";
                $success = $success && false;
            }
        }

        return $success;
    }

    public static function has($key)
    {
        return property_exists( self::class, $key );
    }
}