<?php
namespace devskyfly\php56\libs;

/**
 * Provide use wraped spl functions for base64.
 *
 * @todo Need to cover by tests
 */
class Base64
{
    /**
     * Encode string in base64
     *
     * @link https://www.php.net/manual/en/function.base64-encode.php
     * @param string $val
     * @return string
     */
    public static function encode($val)
    {
        return base64_encode($val);
    }
    
    /**
     * Decode base64 string.
     *
     * @link https://www.php.net/manual/en/function.base64-decode.php
     * @param string $val
     * @throws \RuntimeException
     * @return string
     */
    public static function decodeStrict($val)
    {
        $result = base64_decode($val, true);
        if ($result == false) {
            throw new \RuntimeException('base64_decode function crashed.');
        }
        return $result;
    }
}
