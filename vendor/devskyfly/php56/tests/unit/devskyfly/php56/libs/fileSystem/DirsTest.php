<?php
namespace devskyfly\php56\libs\fileSystem;

class DirsTest extends \Codeception\Test\Unit
{
    public $projectDir = __DIR__.'/../../../../../../';
    
    // tests
    public function testIsDir()
    {   
        $this->assertTrue(Dirs::isDir($this->projectDir.'/src'));
        $this->assertFalse(Dirs::isDir($this->projectDir.'/README.md'));
    }
}
