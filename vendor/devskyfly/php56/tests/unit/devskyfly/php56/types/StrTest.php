<?php
namespace devskyfly\php56\types;

use Symfony\Component\Process\Exception\InvalidArgumentException;

class StrTest extends \Codeception\Test\Unit
{
    public function testIsString()
    {
        $str="Some test";
        $this->assertTrue(Str::isString($str));
        
        $nmb=123;
        $this->assertFalse(Str::isString($nmb));
    }
    
    public function testToString()
    {
        $val=123;
        $str=Str::toString($val);
        $this->assertTrue(Str::isString($str));
    }

    public function testImplode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $result = Str::implode(null, ['one', 'two']);
        $this->expectException(\InvalidArgumentException::class);
        $result = Str::implode(":", null);

        $result = Str::implode(";", ['one', 'two']);
        $this->assertEquals($result, "one;two");
    }
}
