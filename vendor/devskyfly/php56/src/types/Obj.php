<?php
namespace devskyfly\php56\types;

class Obj
{
    /**
     * Return class name including namespace
     *
     * @link https://www.php.net/manual/en/function.get-class.php
     * @param object $name
     * @throws \InvalidArgumentException
     * @return string
     */
    public static function getClassName($object)
    {
        if (!static::isObject($object)) {
            throw new \InvalidArgumentException('Param $object is not object type.');
        }
        return get_class($object);
    }
    
    /**
     * Define whether the variable is object
     *
     * @link https://www.php.net/manual/en/function.is-object.php
     * @param mixed $val
     * @return boolean
     */
    public static function isObject($val)
    {
        return is_object($val);
    }
    
    /**
     * Define whether object belongs to current class or this class is object parent
     *
     * @link https://www.php.net/manual/en/function.is-a.php
     * @param object|string $object - object or class name
     * @param string $class_name
     * @return boolean
     */
    public static function isA($object, $class_name)
    {
        return is_a($object, $class_name);
    }
    
    /**
     * Define whether the class or object is sub class of target class or implements it
     *
     * @link https://www.php.net/manual/en/function.is-subclass-of.php
     * @param object|string $object - object or class name
     * @param string $class_name
     * @return bool
     */
    public static function isSubClassOf($object, $class_name)
    {
        return is_subclass_of($object, $class_name);
    }
}
