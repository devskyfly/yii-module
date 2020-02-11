<?php
namespace devskyfly\php56\libs\arr;

use devskyfly\php56\types\Arr;
use devskyfly\php56\types\Vrbl;
use Symfony\Component\Process\Exception\InvalidArgumentException;
use PhpOffice\PhpSpreadsheet\Calculation\Exception;

class Intersect
{
    /**
     * Returns an associative array containing all the values in array1 that are present in all of the arguments
     *
     * @param array $array_1
     * @param array $array_2
     * @throws \InvalidArgumentException
     */
    public static function getIntersectAssoscByValue($array_1, $array_2)
    {
        if (!Arr::isArray($array_1)) {
            throw new \InvalidArgumentException('Param $array_1 is not array type.');
        }
        if (!Arr::isArray($array_2)) {
            throw new \InvalidArgumentException('Param $array_2 is not array type.');
        }
        return array_intersect_assoc($array1, $array2);
    }
    
    /**
     * Returns an associative array containing all the values in array1 that are present in all of the arguments
     *
     * Computes the intersection of arrays with additional index check, compares indexes by a callback function
     *
     * @param array $array_1
     * @param array $array_2
     * @param string|callable $handler
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function getUserIntersectAssoscByValue($array_1, $array_2, $handler)
    {
        if (!Arr::isArray($array_1)) {
            throw new \InvalidArgumentException('Param $array_1 is not array type.');
        }
        if (!Arr::isArray($array_2)) {
            throw new \InvalidArgumentException('Param $array_2 is not array type.');
        }
        if (!Vrbl::isCallable($handler)) {
            throw new \InvalidArgumentException('Param $handler is not callable type.');
        }
        return array_intersect_uassoc($array1, $array2, $handler);
    }
    
    /**
     * Return elements from array_1 that intersects with array_2 elements by key values
     *
     * @param array $array1
     * @param array $array2
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function getIntersectByKeys($array1, $array2)
    {
        if (!Arr::isArray($array_1)) {
            throw new \InvalidArgumentException('Param $array_1 is not array type.');
        }
        if (!Arr::isArray($array_2)) {
            throw new \InvalidArgumentException('Param $array_2 is not array type.');
        }
        return array_intersect_key($array1, $array2);
    }
    
    /**
     * Return array with elements from array_1 that do not exist in array_2 by key value using user defined function
     *
     * @param array $array_1
     * @param array $array_2
     * @param string|callable $handler
     * @throws \InvalidArgumentException
     * @return array
     */
    public static function getUserIntersectByKeys($array_1, $array_2, $handler)
    {
        if (!Arr::isArray($array_1)) {
            throw new \InvalidArgumentException('Param $array_1 is not array type.');
        }
        if (!Arr::isArray($array_2)) {
            throw new \InvalidArgumentException('Param $array_2 is not array type.');
        }
        if (!Vrbl::isCallable($handler)) {
            throw new \InvalidArgumentException('Param $handler is not callable type.');
        }
        return array_intersect_ukey($array1, $array2, $handler);
    }
    
    
    /**
     * Return array with elements from array_1 that do not exist in array_2
     *
     * @param array $array_1
     * @param array $array_2
     * @throws \InvalidArgumentException
     */
    public static function getIntersect($array_1, $array_2)
    {
        if (!Arr::isArray($array_1)) {
            throw new \InvalidArgumentException('Param $array_1 is not array type.');
        }
        if (!Arr::isArray($array_2)) {
            throw new \InvalidArgumentException('Param $array_2 is not array type.');
        }
        return array_intersect($array1, $array2);
    }

    /**
     * Undocumented function
     * @param [] $arr
     * @throws \InvalidArgumentException
     * @return void
     */
    public static function getIntersectOfArrayItems($arr)
    {
        if (!Arr::isArray($arr)) {
            throw new \InvalidArgumentException('Param $array is not array type.');
        }

        if (empty($arr)) {
            return [];
        }

        foreach ($arr as $key => $itm) {
            if (!\is_array($itm)) {
                throw new \InvalidArgumentException('Param $itm is not array type index="'.$key.'".');
            }
        }

        $items=[];
        $size=count($arr);
        if ($size==1) {
            return $arr[0];
        }
        for ($i=0;$i<($size-1);$i++) {
            for ($j=$i;$j<($size-1);$j++) {
                $items = array_merge(array_intersect($arr[$j], $arr[$j+1]));
            }
        }
        $items = array_unique($items);
        $result = [];
        foreach ($items as $item) {
            $assert = true;
            foreach ($arr as $arr_item) {
                $assert = $assert && in_array($item, $arr_item);
            }
            if ($assert) {
                $result[] = $item;
            }
        }
        return $result;
    }
}
