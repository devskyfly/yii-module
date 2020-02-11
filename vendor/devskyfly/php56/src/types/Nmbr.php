<?php
namespace devskyfly\php56\types;

use RangeException;

class Nmbr
{
    const PI=M_PI;
    const E=M_E;
    const LOG2E=M_LOG2E;
    const LN2=M_LN2;
    const LN10=M_LN10;
    const EULER=M_EULER;
    const NAN=NaN;
    const EPSILON=0.00001;
    const INT_SIZE=PHP_INT_SIZE;
    const INT_MAX=PHP_INT_MAX;
    const ROUND_HALF_UP=PHP_ROUND_HALF_UP;
    const ROUND_HALF_DOWN=PHP_ROUND_HALF_DOWN;
    const ROUND_HALF_EVEN=PHP_ROUND_HALF_EVEN;
    const ROUND_HALF_ODD=PHP_ROUND_HALF_ODD;

    /**
     *
     * @link https://www.php.net/manual/en/language.types.float.php#language.types.float.comparison
     * @param number $val_1
     * @param number $val_2
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public static function isEqual($val_1, $val_2)
    {
        if (!self::isNumeric($val_1)) {
            throw new \InvalidArgumentException("Param val_1 is not numeric.");
        }
        if (!self::isNumeric($val_2)) {
            throw new \InvalidArgumentException("Param val_2 is not numeric.");
        }
        
        if (self::toInteger($val_1)&&self::toInteger($val_2)) {
            if ($val_1==$val_2) {
                return true;
            }
        } else {
            $val_1=self::toDouble($val_1);
            $val_2=self::toDouble($val_2);
            if (abs($val_1-$val_2)<self::EPSILON) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Define whether the variable is NaN
     *
     * NaN is special constant
     *
     * @link https://www.php.net/manual/en/function.is-nan.php
     * @param float $val
     * @return boolean
     */
    public static function isNan($val)
    {
        return is_nan($val);
    }
    
    /**
     * Define whether the variable is numeric
     *
     * @link https://www.php.net/manual/en/function.is-numeric.php
     * @param mixed $val
     * @return boolean
     */
    public static function isNumeric($val)
    {
        return is_numeric($val);
    }
    
    /**
     * Define whether the variable is double
     *
     * @link https://www.php.net/manual/en/function.is-float.php
     * @param mixed $val
     * @return boolean
     */
    public static function isDouble($val)
    {
        return (is_double($val));
    }
    
    
    /**
     * Define whether the variable is int
     *
     * @link https://www.php.net/manual/en/function.is-int.php
     * @param mixed $val
     * @return boolean
     */
    public static function isInteger($val)
    {
        return (is_int($val));
    }
    
    /**
     * Convert value to double
     *
     * It is a wrapper of core function.
     * Generate E_NOTICE and return 1 on object use.
     *
     * @link https://www.php.net/manual/en/function.floatval.php
     * @param mixed $val
     * @throws E_NOTICE
     * @return number
     */
    public static function toDouble($val)
    {
        return floatval($val);
    }
    
    /**
     * Convert value to integer
     *
     * It is a wrapper of core function.
     * Generate E_NOTICE and return 1 on object use.
     *
     * @link https://www.php.net/manual/en/function.intval.php
     * @param mixed $val
     * @throws E_NOTICE
     * @return number
     */
    public static function toInteger($val)
    {
        return intval($val);
    }
    
    /**
     * Convert value to double in strict mode
     *
     * @link https://www.php.net/manual/en/function.floatval.php
     * @param mixed $val
     * @throws \InvalidArgumentException
     * @return number
     */
    public static function toDoubleStrict($val)
    {
        if (!self::isNumeric($val)) {
            throw new \InvalidArgumentException("Param val is not numeric.");
        }

        return floatval($val);
    }
    
    /**
     * Convert value to integer in strict mode
     *
     * @link https://www.php.net/manual/en/function.intval.php
     * @param mixed $val
     * @throws \InvalidArgumentException
     * @return number
     */
    public static function toIntegerStrict($val)
    {
        if (!self::isNumeric($val)) {
            throw new \InvalidArgumentException("Param val is not numeric.");
        }
        return intval($val);
    }

    /**
     * Return absolute value of passed param
     *
     * @link https://www.php.net/manual/en/function.abs.php
     * @param number $val
     * @return number
     */
    public static function abs($val)
    {
        if (!self::isNumeric($val)) {
            throw new \InvalidArgumentException("Param val is not numeric.");
        }

        return abs($val);
    }

    /**
     * Round value down to nearest int.
     *
     * @link https://www.php.net/manual/en/function.floor.php
     * @param number $val
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return void
     */
    public static function roundDown($val)
    {
        if (!self::isNumeric($val)) {
            throw new \InvalidArgumentException("Param val is not numeric.");
        }

        $result = floor($val);
        if ($result === false) {
            throw \RuntimeException('Function floor crashed.');
        }

        return $result;
    }

    /**
     * Round value up to nearest int.
     *
     * @link https://www.php.net/manual/en/function.ceil.php
     * @param number $val
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return void
     */
    public static function roundUp($val)
    {
        if (!self::isNumeric($val)) {
            throw new \InvalidArgumentException("Param val is not numeric.");
        }

        $result = ceil($val);
        if ($result === false) {
            throw \RuntimeException('Function floor crashed.');
        }

        return $result;
    }

    /**
     * Round value
     *
     * @link https://www.php.net/manual/en/function.round.php
     * @param number  $val
     * @param integer $precision
     * @param integer $mode
     * @throws \InvalidArgumentException
     * @throws \RangeException
     * @return number
     */
    public static function round($val, $precision = 0, $mode = self::ROUND_HALF_UP)
    {
        if (!self::isInteger($mode)) {
            throw new \InvalidArgumentException('Param $mode is not integer.');
        }

        if (($mode != self::ROUND_HALF_UP)
            && ($mode != self::ROUND_HALF_DOWN)
            && ($mode != self::ROUND_HALF_ODD)
            && ($mode != self::ROUND_HALF_EVEN)
        ) {
            throw new RangeException('Param $mode is out of the range.');
        }

        if (!self::isNumeric($val)) {
            throw new \InvalidArgumentException('Param $val is not numeric.');
        }

        if (!self::isInteger($presition)) {
            throw new \InvalidArgumentException('Param $precision is not integer.');
        }
        
        if ($precition < 0) {
            throw new \InvalidArgumentException('Param $precision is not positive.');
        }

        return round($val, $precision, $mode);
    }
}
