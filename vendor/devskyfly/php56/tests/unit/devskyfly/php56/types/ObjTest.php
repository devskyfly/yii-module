<?php
namespace devskyfly\php56\types;

class ObjTest extends \Codeception\Test\Unit
{

    // tests
    public function testGetClassName()
    {
        $obj = new \DateTime();
        $name = Obj::getClassName($obj);
        $this->assertEquals($name, "DateTime");

        $this->expectException(\InvalidArgumentException::class);
        Obj::getClassName("str");
    }

    public function testIsObject()
    {
        $val=new \DateTime();
        $this->assertTrue(Obj::isObject($val));

        $val="str";
        $this->assertFalse(Obj::isObject($val));
    }
    
    public function testIsA()
    {
        $class_name=\Exception::class;
        
        $object=new \LogicException();
        $this->assertTrue(Obj::isA($object, $class_name));
        
        $class_name=\DateTime::class;
        $this->assertFalse(Obj::isA($object, $class_name));
    }
    
    public function testIsSubClassOf()
    {
        $obj=new \LogicException();
        
        $this->assertTrue(Obj::isSubClassOf($obj, \Exception::class));
        $this->assertFalse(Obj::isSubClassOf($obj, \DateTime::class));
    }
}
