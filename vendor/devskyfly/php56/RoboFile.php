<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * Needed packages:
 * composer require friendsofphp/php-cs-fixer --dev
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    use Robo\Task\Base\loadShortcuts;

    //TESTS

    public function testsUnit()
    {
        $tsk = $this->_exec("./vendor/codeception/codeception/codecept run unit");
    }

    public function testsFunctional()
    {
        $tsk = $this->_exec("./vendor/codeception/codeception/codecept run functional");
    }

    public function testsAcceptance()
    {
        $tsk = $this->_exec("./vendor/codeception/codeception/codecept run acceptance");
    }

    //PHP-CS

    public function phpcsSrc()
    {
        $tsk = $this->_exec("./vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix ./src --verbose"); 
    }

    public function phpcsTests()
    {
        $tsk = $this->_exec("./vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix ./src --verbose"); 
    }
}