<?php
namespace devskyfly\php56\libs\fileSystem;

class SystemTest extends \Codeception\Test\Unit
{
    public $projectDir = __DIR__.'/../../../../../../';
    
    // tests
    public function testSomeFeature()
    {   
        $this->assertTrue(System::exists($this->projectDir.'/README.md'));
        $this->assertFalse(System::exists($this->projectDir.'/README.md1'));
    }

    public function testLink()
    {
        if(System::exists($this->projectDir.'/src_link')){
            System::delete($this->projectDir.'/src_link'); 
        }
        $result = System::symlink($this->projectDir.'/src', $this->projectDir.'/src_link');
        $this->assertTrue($result);
        $this->assertTrue(System::exists($this->projectDir.'/src_link'));
        $this->assertTrue(System::isLink($this->projectDir.'/src_link'));
        $this->assertTrue(System::delete($this->projectDir.'/src_link'));
        $this->assertFalse(System::exists($this->projectDir.'/src_link'));
    }
}
