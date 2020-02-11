<?php
namespace devskyfly\yiiModule\widgets;

use devskyfly\php56\types\Arr;

use yii\base\Widget;

class NavigationMenu extends Widget
{
    public $routePrefix = "";
    public $info = [];
    
    public function init()
    {
        parent::init();

        if (!Arr::isArray($this->info)) {
            throw new \InvalidArgumentException('Property $info is not array type.');
        }
    }
    
    public function run()
    {
        $info = $this->info;
        $routePrefix = $this->routePrefix;
        return $this->render('navigation-menu', compact("info", "routePrefix"));
    }
}

