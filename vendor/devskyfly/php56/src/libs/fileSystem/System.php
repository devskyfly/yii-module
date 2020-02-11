<?php
namespace devskyfly\php56\libs\fileSystem;

use devskyfly\php56\types\Str;
use SebastianBergmann\Environment\Runtime;
use devskyfly\php56\types\Lgc;

class System
{
    const SEEK_SET = SEEK_SET;
    const SEEK_CUR = SEEK_CUR;
    const SEEK_END = SEEK_END; 
    const LOCK_SH  = LOCK_SH;
    const LOCK_EX  = LOCK_EX;
    const LOCK_UN  = LOCK_UN;
    const LOCK_NB = LOCK_NB;
    const GLOB_BRACE = GLOB_BRACE;
    const GLOB_ONLYDIR = GLOB_ONLYDIR;
    const GLOB_MARK = GLOB_MARK;
    const GLOB_NOSORT = GLOB_NOSORT;
    const GLOB_NOCHECK = GLOB_NOCHECK;
    const GLOB_NOESCAPE = GLOB_NOESCAPE;
    const GLOB_AVAILABLE_FLAGS = GLOB_AVAILABLE_FLAGS;
    const PATHINFO_DIRNAME = PATHINFO_DIRNAME;
    const PATHINFO_BASENAME = PATHINFO_BASENAME;
    const PATHINFO_EXTENSION = PATHINFO_EXTENSION;
    const PATHINFO_FILENAME = PATHINFO_FILENAME;
    const FILE_USE_INCLUDE_PATH = FILE_USE_INCLUDE_PATH;
    const FILE_NO_DEFAULT_CONTEXT = FILE_NO_DEFAULT_CONTEXT;
    const FILE_APPEND = FILE_APPEND;
    const FILE_IGNORE_NEW_LINES = FILE_IGNORE_NEW_LINES;
    const FILE_SKIP_EMPTY_LINES = FILE_SKIP_EMPTY_LINES;
    const FILE_BINARY = FILE_BINARY;
    const FILE_TEXT = FILE_TEXT;
    const INI_SCANNER_NORMAL = INI_SCANNER_NORMAL;
    const INI_SCANNER_RAW = INI_SCANNER_RAW;
    const INI_SCANNER_TYPED = INI_SCANNER_TYPED;
    const FNM_NOESCAPE = FNM_NOESCAPE;
    const FNM_PATHNAME = FNM_PATHNAME;
    const FNM_PERIOD = FNM_PERIOD;
    const FNM_CASEFOLD = FNM_CASEFOLD;


    /**
     *Check whether file or dir exists
     * 
     * @link https://www.php.net/manual/en/function.file-exists.php
     * @param string $path
     * @param bool $strict
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public static function exists($path, $strict = false)
    {
        if (!Str::isString($path)) {
            throw new \InvalidArgumentException('Parameter $path is not string type.');
        }

        if (!Lgc::isBoolean($strict)) {
            throw new \InvalidArgumentException('Parameter $strict is not string type.');
        }
        if (!$strict) {
            $path = realpath($path);
        } 
        return file_exists($path);
    }
    
    /**
     * Create link on target
     *
     * @link https://www.php.net/manual/en/function.symlink.php
     * @param string $target
     * @param string $link
     * @return bool
     */
    public static function symlink($target, $link)
    {
        if (!Str::isString($target)) {
            throw new \InvalidArgumentException('Param $target is not string type.');
        }
        if (!Str::isString($link)) {
            throw new \InvalidArgumentException('Param $link is not string type.');
        }

        return symlink($target, $link);
    }


    /**
     * Delete target file
     *
     * @link https://www.php.net/manual/en/function.unlink.php
     * @param string $target
     * @throws \InvalidArgumentException
     * @return void
     */
    public static function delete($target)
    {
        if (!Str::isString($target)) {
            throw new \InvalidArgumentException('Param $target is not string type.');
        }

        return unlink($target);
    }

    /**
     * Check  is link.
     *
     * @link https://www.php.net/manual/en/function.is-link.php
     * @param string $path
     * @return boolean
     */
    public static function isLink($path)
    {
        if (!Str::isString($path)) {
            throw new \InvalidArgumentException('Parameter $path is not string type');
        }
        return is_link($path);
    }
    
    /**
     * Return files and directories by pattern.
     *
     * @link https://www.php.net/manual/en/function.glob.php
     * @param string $pattern
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @todo Need to cover by tests.
     * @return []
     */
    public static function getFilesByPattern($pattern)
    {
        if (!Str::isString($pattern)) {
            throw new \InvalidArgumentException('Parameter $pattern is not string type');
        }
        $result = glob($pattern);

        if ($result === false) {
            throw new \RuntimeException('glob function crashed.');
        }

        return $result;
    }
}
