<?php
namespace devskyfly\php56\libs;

/**
 * @todo Need to cover by tests.
 */
class Http
{
    /**
     * Return headers as associative array from remote server on request answer
     *
     * @link https://www.php.net/manual/en/function.get-headers.php
     * @param string $url
     * @throws \RuntimeException
     * @return array
     * @todo Need to cover by test
     */
    public static function getHeaders($url)
    {
        $result = get_headers($url, 1);
        if ($result === false) {
            throw new \RuntimeException('get_headers function crashed.');
        }
        return $result;
    }
}
