<?php
namespace devskyfly\php56\libs\fileSystem;

use devskyfly\php56\types\Str;

/**
 * @todo Need to cover by tests
 */
class Dirs
{

    /**
     * Delete dir only if empty.
     *
     * Directory must be empty
     * 
     * @link https://www.php.net/manual/en/function.rmdir.php
     * @param string $path
     * @throws E_WARNING
     * @todo Need to cover by tests
     * @return boolean
     */
    public static function deleteDir($path)
    {
        if (!Str::isString($path)) {
            throw new \InvalidArgumentException('Parameter $path is not string type');
        }
        return rmdir($path);
    }
    
    /**
     * Delete hole dir recursively with its files.
     *
     * @param string $path
     * @throws E_WARNING
     * @todo Need to cover by tests
     * @return boolean
     */
    public static function deleteDirR($path)
    {
        if (!Str::isString($path)) {
            throw new \InvalidArgumentException('Parameter $path is not string type');
        }
        
        $files = array_diff(scandir($path), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$path/$file")) ? self::deleteDirR("$path/$file") : unlink("$path/$file");
        }
        return rmdir($path);
    }
    
    /**
     * Define whether file exists.
     *
     * @link https://www.php.net/manual/en/function.file-exists.php
     * @deprecated
     * @param string $path
     * @return boolean
     */
    public static function dirExists($path)
    {
        return System::exists($path);
    }
    

    /**
     * Check is dir.
     *
     * @link https://www.php.net/manual/en/function.is-dir.php
     * @param string $path
     * @return boolean
     */
    public static function isDir($path)
    {
        if (!Str::isString($path)) {
            throw new \InvalidArgumentException('Parameter $path is not string type');
        }
        return is_dir($path);
    }
    
   
    /**
     * Return files and directories by pattern.
     *
     * @deprecated
     * @link https://www.php.net/manual/en/function.glob.php
     * @param string $pattern
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return []
     */
    public static function getFilesByPattern($pattern)
    {
        System::getFilesByPattern($pattern);
    }
    
    /**
     * List files and directories inside $path
     *
     * @param string $path
     * @throws \InvalidArgumentException
     * @throws E_WARNING
     * @return array
     */
    public static function scanDir($path)
    {
        if (!Str::isString($path)) {
            throw new \InvalidArgumentException('Parament $path is not string type');
        }
        return scandir($path);
    }
}
