<?php
namespace devskyfly\yiiModule;

use Yii;
use yii\helpers\BaseInflector;

/** 
 * 
*/
abstract class AbstractModule extends \yii\base\Module
{   
    /**
     *
     * @var array - [
     * [
     * "label" => ["name":string , "route":string]
     * "sub_list" =>[ 
     *      ["name":string, "route":string]
     * ]
     * ],...];
     */
    public $navigationInfo = [];

    public function init()
    {
        parent::init();

        $namespace = lcfirst(BaseInflector::id2camel(static::package()));
        
        Yii::setAlias('@'.static::vendor().'/'.$namespace, static::dir());
        
        /**
         * Define controller namespace for console application.
         */
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = static::vendor().'\\'.$namespace.'\\console';
        } 

        $this->initNavigationInfo();
    }
    
    /**
     * @return void
     */
    public function getNavigationInfo()
    {
        return $this->navigationInfo;
    }

    /**
     *
     * @return $this
     */
    abstract public function initNavigationInfo();

    /**
     *
     * @return string
     */
    abstract public static function title();

    /**
     *
     * @return string
     */
    abstract public static function cssNamespace();

    /**
     * @return string
     */
    public static function getRoute()
    {
        return "/".(static::getInstance())->id;
    }

    /**
     * @return string 
     */
    abstract public static function dir();

    /**
     * @return string
     */
    abstract public static function vendor();
    
    /**
     * @return string
     */
    abstract public static function package(); 

    /**
     * @return string
     */
    abstract public static function tablesPrefix();
}