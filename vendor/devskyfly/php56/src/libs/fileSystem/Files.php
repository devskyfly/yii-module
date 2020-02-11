<?php
namespace devskyfly\php56\libs\fileSystem;

use devskyfly\php56\types\Str;

class Files
{
    /**
     * Delete file.
     *
     * N.B. Generate E_WARNING error on failure.
     * 
     * @deprecated
     * @param string $path - file name
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public static function deleteFile($path)
    {
        return System::delete($path);
    }
    
    /**
     * Define whether file exists.
     *
     * @deprecated
     * @param string $path
     * @return boolean
     */
    public static function fileExists($path)
    {
        return System::exists($path);
    }

    /**
     * Check  is file.
     *
     * @link https://www.php.net/manual/en/function.is-file.php
     * @param string $path
     * @return boolean
     */
    public static function isFile($path)
    {
        if (!Str::isString($path)) {
            throw new \InvalidArgumentException('Parameter $path is not string type');
        }
        return is_file($path);
    }
}
