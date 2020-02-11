<?php
namespace devskyfly\php56\types;

/**
 *
 * @author devskyfly
 *
 * Because its imposible to redeclarate:
 * -use isset() to check if variable exists
 * -use unset() to delete variable
 * -use get_defined_vars() to get all defined variables
 */
class Vrbl
{
    /**
     * Return value of array or object if it exists otherwise return default value param instead
     *
     * @param array|object $entity
     * @param string $name
     * @param mixed $defaultValue
     * @return void
     */
    public static function getValue($entity, $name, $defaultValue=null)
    {
        if (!Str::isString($name)) {
            throw new \InvalidArgumentException('Param $name is not string type.');
        }

        if ((!is_array($entity))&&(!is_object($entity))) {
            throw new \InvalidArgumentException('Param $entity is not array or object type.');
        }
        
        if (isset($entity, $name)) {
            if (\is_object($entity)) {
                return $entity->$name;
            } else {
                return $entity[$name];
            }
        } else {
            return $defaultValue;
        }
    }

    /**
     * Define whether the variable is null value
     *
     * @link https://www.php.net/manual/en/function.is-null.php
     * @param mixed $val
     * @return boolean
     */
    public static function isNull($val)
    {
        return is_null($val);
    }
    
    /**
     * Define whether the variable is empty
     *
     * For different types empty varibles are:
     * "" - string
     * 0 - number
     * [] - array
     * null - refference
     *
     * @link https://www.php.net/manual/en/function.empty.php
     * @param mixed $val
     * @return boolean
     */
    public static function isEmpty($val)
    {
        return empty($val);
    }
    
    /**
     * Define whether the variable is scalar
     *
     * Scalar is a simple type. Array, object, null and resource are not scalar
     *
     * @link https://www.php.net/manual/en/function.is-scalar.php
     * @param mixed $val
     * @return boolean
     */
    public static function isScalar($val)
    {
        return is_scalar($val);
    }
    
    /**
     * Define whether the variable is iterable variable
     *
     * @link https://www.php.net/manual/en/function.is-iterable.php
     * @param mixed $val
     * @return boolean
     */
    public static function isIterable($val)
    {
        return is_iterable($val);
    }
    
    /**
     * Define whether the variable is countable variable
     *
     * @link https://www.php.net/manual/en/function.is-countable.php
     * @since php7.3
     * @param mixed $val
     * @return boolean
     */
    /*public static function isCountable($val)
    {
        return is_countable($val);
    }*/
    
    /**
     * Define whether the variable is callable
     *
     * @link https://www.php.net/manual/en/function.is-callable.php
     * @param mixed $val
     * @return boolean
     */
    public static function isCallable($val)
    {
        return is_callable($val);
    }
    
    /**
     * Return the type of PHP variable
     *
     * @link https://www.php.net/manual/en/function.gettype.php
     * @param mixed $val
     * @return string boolean, integer, double, string, array, object, resource, NULL, unknown type
     */
    public static function getType($val)
    {
        return gettype($val);
    }
    
    /**
     * Set type of variable
     *
     * @link https://www.php.net/manual/en/function.settype.php
     * @param mixed $val
     * @param string $type boolean, int, double, string, array, object, null
     * @return boolean
     */
    public static function setType(&$val, $type)
    {
        return settype($val, $type);
    }
    
    /**
     * Generates a storable representation of value
     *
     * @link https://www.php.net/manual/en/function.serialize.php
     * @param mixed $val
     * @return string
     * @todo Need to cover
     */
    public static function serialize($val)
    {
        return serialize($val);
    }
    
    /**
     * Create PHP value from a stored representation
     *
     * @link https://www.php.net/manual/en/function.unserialize.php
     * @param string $val
     * @return mixed
     * @todo Need to cover by test
     */
    public static function unserialize($val)
    {
        return unserialize($val);
    }
    
    /**
     * Display human representation of the variable
     *
     * @link https://www.php.net/manual/en/function.print-r.php
     * @param mixed $val
     */
    public static function printR($val, $return = false)
    {
        if (!Lgc::isBoolean($return)) {
            throw new \InvalidArgumentException('Param $return is not boolean type.');
        }
        return print_r($val, $return);
    }
    
    /**
     * Return human representation of the variable
     *
     * @link https://www.php.net/manual/en/function.print-r.php
     * @param mixed $val
     * @return string
     */
    public static function rPrintR($val)
    {
        return print_r($val, true);
    }
    
    /**
     * Displays structured information about variable
     *
     * @param mixed $val
     * @todo Need to cover by test
     */
    public static function varDump($val)
    {
        var_dump($val);
    }
    
    /**
     * Outputs or return parsable string representation of a variable
     *
     * @link https://www.php.net/manual/en/function.var-export.php
     * @param mixed $val
     * @param boolean $return
     */
    public static function varExport($val, $return=false)
    {
        if (!Lgc::isBoolean($return)) {
            throw new \InvalidArgumentException('Param $return is not boolean type.');
        }
        return var_export($val, $return);
    }
}
