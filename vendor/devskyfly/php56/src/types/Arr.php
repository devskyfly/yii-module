<?php
namespace devskyfly\php56\types;

use OutOfBoundsException;

class Arr
{
    const ARRAY_FILTER_USE_KEY=ARRAY_FILTER_USE_KEY;
    const ARRAY_FILTER_USE_BOTH=ARRAY_FILTER_USE_BOTH;
    
    /**
     * Define whether the variable is array
     *
     * @param mixed $val
     * @return boolean
     */
    public static function isArray($val)
    {
        return is_array($val);
    }
    
    /**
     * Define whether item is exists in array
     *
     * If strict is true, then compare mode will be strict
     * @param mixed $needle
     * @param array $haystack
     * @return boolean
     */
    public static function inArray($needle, $haystack, $strict=false)
    {
        return in_array($needle, $haystack, $strict=false);
    }
    
    /**
     * Return an array of strings, each of which is a substring of string
     * formed by splitting it on boundaries formed by the string delimiter.
     *
     * @param string $delimeter
     * @param string $str
     * @throws \InvalidArgumentException
     */
    public static function explode($delimeter, $str)
    {
        if (!Str::isString($delimeter)) {
            throw new \InvalidArgumentException('Parameter $delimiter is not string type.');
        }
        if (!Str::isString($str)) {
            throw new \InvalidArgumentException('Parameter $str is not string type.');
        }
        if (!Vrbl::isEmpty($str)) {
            throw new \InvalidArgumentException('Parameter $str is empty.');
        }
            
        return explode($delimeter, $str);
    }
    
    /**
     * Return array size
     *
     * @param array $array
     * @throws \InvalidArgumentException
     * @return integer
     */
    public static function getSize($array)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        return count($array);
    }


    /**
     * Return indexed array of values
     *
     * @link https://www.php.net/manual/ru/function.array-values.php
     * @param [type] $array
     * @return void
     */
    public static function getValues($array)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        return array_values($array);
    }
    
    /**
     * Return array with keys that were values and digit that equal to value freqvecy
     *
     * @param array $array
     * @throws \InvalidArgumentException
     */
    public static function countValues($array)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        return array_count_values($array);
    }
    
    /**
     * Return chuncked array
     *
     * Return array with elements separeted by size.
     * If save_keys param is true - keys values are saved.
     * @link https://www.php.net/manual/ru/function.array-chunk.php
     * @param array $array
     * @param int $size
     * @param boolean $save_keys
     * @return array
     */
    public static function getChunked($array, $size, $save_keys=false)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        
        if (!Nmbr::isInteger($size)) {
            throw new \InvalidArgumentException('Param $size is not integer type.');
        }
        
        if (!Lgc::isBoolean($save_keys)) {
            throw new \InvalidArgumentException('Param $save_keys is not bool type.');
        }
        return array_chunk($array, $size, $save_keys);
    }
    
    /**
     * Return column of passed array
     *
     * If index_key param is set, return value items would have index keys from this index key
     *
     * @link https://www.php.net/manual/ru/function.array-column.php
     * @param array $array
     * @param integer|string|null $column
     * @param integer|string|null $index_column
     * @return array
     */
    public static function getColumn($array, $column, $index_column=null)
    {
        return array_column($array, $column, $index_column);
    }
    
    /**
     * Return array indexed by column value, but not ordered
     *
     * Notice that returned array has index values related to column value in order.
     * But items in result array is not sorted by index.
     *
     * @link https://www.php.net/manual/ru/function.array-column.php
     * @throws \InvalidArgumentException
     * @param array $array
     * @param integer|string $index_column
     * @return array
     */
    public static function indexByColumn($array, $index_column)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
              
        if (!self::columnExists($array, $index_column)) {
            throw new \InvalidArgumentException('Key '.$index_column.' does not exist');
        }
        
        return array_column($array, null, $index_column);
    }
    
    /**
     * Define whether array have key
     *
     * @link https://www.php.net/manual/ru/function.array-key-exists.php
     * @param array $array
     * @param string|integer $key
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public static function keyExists($array, $key)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        
        if ((!Str::isString($key))&&(!Nmbr::isInteger($key))) {
            throw new \InvalidArgumentException('Param $key is not string or integer type.');
        }
            
        return array_key_exists($key, $array);
    }
    
    /**
     * Define whether array have column
     *
     * In other words, if every row have neaded key function return true
     * @param array $array
     * @param string|integer $key
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public static function columnExists($array, $key)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        
        if ((!Str::isString($key))&&(!Nmbr::isInteger($key))) {
            throw new \InvalidArgumentException('Param $key is not string or integer type.');
        }
        
        foreach ($array as $item) {
            if (!self::keyExists($item, $key)) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * Return array with keys and values consistes from passed params
     *
     * @link https://www.php.net/manual/ru/function.array-combine.php
     * @param array $keys
     * @param array $values
     * @throws \InvalidArgumentException
     * @throws \Exception
     * @return array
     */
    public static function getCombined($keys, $values)
    {
        if (!self::isArray($keys)) {
            throw new \InvalidArgumentException('Param $keys is not array type.');
        }
        if (!self::isArray($values)) {
            throw new \InvalidArgumentException('Param $values is not array type.');
        }
        if (self::getSize($keys)!=self::getSize($values)) {
            throw new \Exception('Arrays size is not equal.');
        }
        
        return array_combine($keys, $values);
    }
    
    /**
     * Create array with passed keys and fill it by value
     *
     * @link https://www.php.net/manual/ru/function.array-fill-keys.php
     * @param array $keys
     * @param mixed $values
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function createArrayUsingKeysAndValues($keys, $value)
    {
        if (!self::isArray($keys)) {
            throw new \InvalidArgumentException('Param $keys is not array type.');
        }
        return array_fill_keys($keys, $value);
    }
    
    /**
     * Create array using range
     *
     * @link https://www.php.net/manual/ru/function.range.php
     * @param integer $start
     * @param integer $end
     * @param number $step
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function createArrayByRange($start, $end, $step=1)
    {
        if (!Nmbr::isInteger($start)) {
            throw new \InvalidArgumentException('Param $start is not array type.');
        }
        if (!Nmbr::isInteger($end)) {
            throw new \InvalidArgumentException('Param $end is not array type.');
        }
        if (!Nmbr::isInteger($step)) {
            throw new \InvalidArgumentException('Param $step is not array type.');
        }
        
        return range($start, $end, $step);
    }
    
    /**
     * Create array by filling it's items
     *
     * @link https://www.php.net/manual/ru/function.array-fill.php
     * @param integer $start
     * @param integer $end
     * @param mixed $value
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function createFilledByValue($start, $end, $value)
    {
        if (!Nmbr::isInteger($start)) {
            throw new \InvalidArgumentException('Param $start is not array type.');
        }
        if (!Nmbr::isInteger($end)) {
            throw new \InvalidArgumentException('Param $end is not array type.');
        }
        return array_fill($start, $end, $value);
    }
    
    /**
     * Return filtered array.
     *
     * @link array_filter
     * @param array $array
     * @param callable $handler
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function getFiltered($array, $handler)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        if (!Vrbl::isCallable($handler)) {
            throw new \InvalidArgumentException('Param $handler is not array type.');
        }
        return array_filter($array, $handler, self::ARRAY_FILTER_USE_BOTH);
    }
    
    /**
     * Change keys and values between each other
     *
     * @link https://www.php.net/manual/ru/function.array-flip.php
     * @param array $array
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return array
     */
    public static function getFliped($array)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        $result=array_flip($array);
        if (Vrbl::isNull($result)) {
            throw new \RuntimeException("Array flip exception.");
        }
        return $result;
    }
    
    /**
     * Aplly handler function to each array element
     *
     * @link https://www.php.net/manual/ru/function.array-map.php
     * @param callable $handler
     * @param array $array
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function map($handler, $array)
    {
        if (!Vrbl::isCallable($handler)) {
            throw new \InvalidArgumentException('Param $handler is not callable type.');
        }
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        return array_map($handler, $array);
    }
    
    /**
     * Merge arrays
     * @param array $array_1
     * @param array $array_2
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function merge($array_1, $array_2)
    {
        if (!self::isArray($array_1)) {
            throw new \InvalidArgumentException('Param $array_1 is not array type.');
        }
        if (!self::isArray($array_2)) {
            throw new \InvalidArgumentException('Param $array_2 is not array type.');
        }
        return array_merge($array_1, $array_2);
    }
    
    /**
     * Create array from another by filling addition elements by value to defined size
     *
     * If $size <= size of $array only copy would return
     *
     * @link https://www.php.net/manual/ru/function.array-pad.php
     * @param array $array
     * @param integer $size
     * @param mixed $value
     * @return array
     */
    public static function getFilledToSizeByValue($array, $size, $value)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        if (!Nmbr::isInteger($size)) {
            throw new \InvalidArgumentException('Param $size is not integer type.');
        }
        
        return array_pad($array, $size, $value);
    }
    
    /**
     * Add item to array
     *
     * @link https://www.php.net/manual/ru/function.array-push.php
     * @param array $array
     * @param mixed $value
     * @throws \InvalidArgumentException
     * @return integer
     */
    public static function pushItem(&$array, $value)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        return array_push($array, $value);
    }
    
    /**
     * Remove last item from array and set it to item parameter
     *
     * @link https://www.php.net/manual/ru/function.array-pop.php
     * @param array $array
     * @param mixed $item
     * @throws \InvalidArgumentException
     * @return bool
     */
    public static function popItem(&$array, &$item)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }

        $val = array_pop($array);
        
        if (Vrbl::isNull($val)) {
            return false;
        } else {
            $item = $val;
            return true;
        }
    }
    
    /**
     * Return first item of array, decrease array length.
     *
     * All digit keys would be edited by order from 0, all string keys save old values
     *
     * @link https://www.php.net/manual/ru/function.array-shift.php
     * @param array $array
     * @param mixed $item
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public static function shiftItem(&$array, &$item)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }

        $val = array_shift($array);
        
        if (Vrbl::isNull($val)) {
            return false;
        } else {
            $item = $val;
            return true;
        }
    }
    
    /**
     * Product array element and return it
     *
     * @link https://www.php.net/manual/ru/function.array-product.php
     * @param array $array
     * @throws \InvalidArgumentException
     * @return number
     */
    public static function getProduct($array)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        return array_product($array);
    }
    
    /**
     * Sum array element and return it
     *
     * @link https://www.php.net/manual/ru/function.array-sum.php
     * @param array $array
     * @throws \InvalidArgumentException
     * @return number
     */
    public static function getSumm($array)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        return array_sum($array);
    }
    
    /**
     * Return serveral random array elements
     *
     * @link https://www.php.net/manual/ru/function.array-rand.php
     * @param array $array
     * @param number $num
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public static function getRand($array, $num=1)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        if (!Nmbr::isInteger($num)) {
            throw new \InvalidArgumentException('Param $num is not integer type.');
        }

        if (Arr::getSize($array)<=$num) {
            throw new \InvalidArgumentException('Param $num is bigger then passed $array size.');
        }
        return array_rand($array, $num);
    }
    
    /**
     * Return slice of array
     *
     * @link https://www.php.net/manual/ru/function.array-slice.php
     * @param array $array
     * @param integer $offset
     * @param integer|null $length
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function getSlice($array, $offset, $length=null)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        if (!Nmbr::isInteger($offset)) {
            throw new \InvalidArgumentException('Param $offset is not integer type.');
        }
        if (!Vrbl::isNull($length)) {
            if (!Nmbr::isInteger($length)) {
                throw new \InvalidArgumentException('Param $length is not integer type.');
            }
            $cnt=self::getSize($array);
            if ($cnt<($offset+$length)) {
                throw new \InvalidArgumentException('Array slice is bigger then target array.');
            }
        }
        return array_slice($array, $offset, $length);
    }
    
    
    
    /**
     * Replace array items, if replacement is not empty array, use it for replacement
     * @param array $array
     * @param integer $offset
     * @param integer $length
     * @param array $replacement
     * @throws \InvalidArgumentException
     * @throws \LengthException
     * @return array
     */
    public static function splice(&$array, $offset, $length=null, $replacement=[])
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        if (!Nmbr::isInteger($offset)) {
            throw new \InvalidArgumentException('Param $offset is not integer type.');
        }
        if (!Vrbl::isNull($length)) {
            if (!Nmbr::isNumber($length)) {
                throw new \InvalidArgumentException('Param $length is not integer type.');
            }
            $cnt=self::getSize($array);
            if ($cnt<($offset+$length)) {
                throw new \LengthException('Array slice is bigger then target array.');
            }
        }
        if (!self::isArray($replacement)) {
            throw new \InvalidArgumentException('Param $replacement is not array type.');
        }
        return array_splice($array, $num, $length, $replacement);
    }
    
    /**
     * Replace elements in master array  by elements from slave array by equal keys, and add elements from slave array to master if there is no such keys in master like in slave.
     *
     * @link https://www.php.net/manual/ru/function.array-replace.php
     * @param array $master
     * @param array $slave
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return array
     */
    public static function replace($master, $slave)
    {
        if (!self::isArray($master)) {
            throw new \InvalidArgumentException('Param $master is not array type.');
        }
        if (!self::isArray($slave)) {
            throw new \InvalidArgumentException('Param $slave is not array type.');
        }

        $result = array_replace($master, $slave);

        if (Vrbl::isNull($result)) {
            throw new \RuntimeException("Execution of array_replace function was crashed.");
        }

        return array_replace($master, $slave);
    }
    
    /**
     * Return array with element binded with keys in reverse order
     *
     * @link https://www.php.net/manual/ru/function.array-reverse.php
     * @param array $array
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function reverse($array)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        return array_reverse($array);
    }
    
    /**
     * Search first match and return its first index
     *
     * @link https://www.php.net/manual/ru/function.array-search.php
     * @param array $array
     * @param mixed $target
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public static function search($array, $target)
    {
        if (!self::isArray($array)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }
        return array_search($target, $search);
    }
    
    //NEAD TO DEFINE
    public static function replaceRecursive()
    {
    }
    
    public static function getReduce()
    {
    }
    
    public static function mergeRecursive()
    {
    }
    
    public static function multiSort()
    {
    }
}
