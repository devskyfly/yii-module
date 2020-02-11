<?php
namespace devskyfly\php56\types;

class Lgc
{
    
    /**
     * Define whether the variable is boolean
     *
     * @link https://www.php.net/manual/en/function.is-bool.php
     * @param mixed $val
     * @return boolean
     */
    public static function isBoolean($val)
    {
        return is_bool($val);
    }
    
    /**
     * Convert value to bool
     *
     * @link https://www.php.net/manual/en/function.boolval.php
     * @param mixed $val
     * @return boolean
     */
    public static function toBoolean($val)
    {
        return boolval($val);
    }
}
