<?php
namespace devskyfly\php56\libs\fileSystem;

class FilesTest extends \Codeception\Test\Unit
{
    public $projectDir = __DIR__.'/../../../../../../';
    
    // tests
    public function testIsFile()
    {   
        $this->assertTrue(Files::isFile($this->projectDir.'/README.md'));
        $this->assertFalse(Files::isFile($this->projectDir.'/src'));
    }
}
