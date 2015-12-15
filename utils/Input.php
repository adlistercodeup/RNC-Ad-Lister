<?php

class Input {

    // This function verifies that the variable is set and it is not an empty string
    public static function notEmpty($key) {

        if (isset($_REQUEST[$key]) && $_REQUEST[$key] != '') {

            return true;
        }


        // throw new LengthException('Please type in values') . PHP_EOL;
    }
    /**
     * Check if a given value was passed in the request
     *
     * @param string $key index to look for in request
     * @return boolean whether value exists in $_POST or $_GET
     */
    public static function has($key) {
        // TODO: Fill in this function

        return (isset($_REQUEST[$key])) ? true: false;
    }

    // escape($input): returns the input as a safely escaped string.
    public static function escape($input) {
        return htmlspecialchars(strip_tags($input));
    }


    /**
     * Get a requested value from either $_POST or $_GET
     *
     * @param string $key index to look for in index
     * @param mixed $default default value to return if key not found
     * @return mixed value passed in request
     */
    public static function get($key, $default = null) {
        // TODO: Fill in this function
        return  (self::has($key)) ? self::escape($_REQUEST[$key]) : null;
    }

    public static function getString($key, $min = 1, $max = 100) {

        $value = trim(self::get($key));

        $lengthValue = strlen($value);

        if ((!is_string($value)) || (!ctype_alpha($min) && (!ctype_alpha($max)))) {

            throw new InvalidArgumentException("Not a text string!");
        } elseif (!is_string($value)) {

            throw new DomainException('Input has to be a string');
        } elseif (($lengthValue < $min)  || ($lengthValue > $max)) {

            throw new LengthException('The length');
        }

            return $value;
    }

    public static function getNumber($key) {
        
        $value = trim(self::get($key));

        $lengthValue = strlen($value);

        if (!ctype_digit($value)) {

                throw new InvalidArgumentException("Not a text string!");
            }    
                return $value;
    }

    public static function getDate($key) {

        $value =trim(self::get($key));

        try {

            $newDate = new DateTime($value); 

        } catch (Exception $e) {

            throw new datexception('Invalid date');

        }

        return $newDate;


    }



    ///////////////////////////////////////////////////////////////////////////
    //                      DO NOT EDIT ANYTHING BELOW!!                     //
    // The Input class should not ever be instantiated, so we prevent the    //
    // constructor method from being called. We will be covering private     //
    // later in the curriculum.                                              //
    // ///////////////////////////////////////////////////////////////////////////
    
    private function __construct() {



    }


}