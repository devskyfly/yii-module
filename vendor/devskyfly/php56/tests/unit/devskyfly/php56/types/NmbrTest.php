<?php
namespace devskyfly\php56\types;

class NmbrTest extends \Codeception\Test\Unit
{

    public function testIsEqual()
    {
        $val_1=1;
        $val_2=1;
        
        $this->assertTrue(Nmbr::isEqual($val_1, $val_2));
        
        $val_1=0.9;
        $val_2=0.9;
        
        $this->assertTrue(Nmbr::isEqual($val_1, $val_2));
        
        $this->expectException(\InvalidArgumentException::class);
        
        $val_1="str";
        $val_2="str";
        
        Nmbr::isEqual($val_1, $val_2);
    }

    public function testIsNan()
    {
        $val=NAN;
        $this->assertTrue(Nmbr::isNan($val));
        
        $val=0.5;
        $this->assertFalse(Nmbr::isNan($val));
        
    }

    public function testIsNumeric()
    {
        $val=1;
        $this->assertTrue(Nmbr::isNumeric($val));
        
        $val=1.5;
        $this->assertTrue(Nmbr::isNumeric($val));
        
        $val="1.5";
        $this->assertTrue(Nmbr::isNumeric($val));
        
        $val="1.5 str";
        $this->assertFalse(Nmbr::isNumeric($val));
        
        $val="str";
        $this->assertFalse(Nmbr::isNumeric($val));
    }

    public function testIsDouble()
    {
        $val=0.5;
        $this->assertTrue(Nmbr::isDouble($val));

        $val=1;
        $this->assertFalse(Nmbr::isDouble($val));

        
    }
    
    public function testIsInteger()
    {
        $val=1;
        $this->assertTrue(Nmbr::isInteger($val));
        
        $val="str";
        $this->assertFalse(Nmbr::isInteger($val));
    }
    
    public function testToDouble()
    {
        $val="1.5";
        $this->assertTrue(Nmbr::isEqual(Nmbr::toDouble($val), 1.5));
        
        $val=1;
        $this->assertTrue(Nmbr::isEqual(Nmbr::toDouble($val), 1.0));
        
        $val="str";
        $result=Nmbr::toDouble($val);
    }
    
    public function testToInteger()
    {
        $val="1";
        $this->assertTrue(Nmbr::isEqual(Nmbr::toInteger($val), 1));
        
        $val=1;
        $this->assertTrue(Nmbr::isEqual(Nmbr::toInteger($val), 1.0));
        
        $val="str";
        $result=Nmbr::toInteger($val);
        $this->assertEquals(0, $result);
    }
    
    public function testToDoubleStrict()
    {
        $val="1.5";
        $this->assertTrue(Nmbr::isEqual(Nmbr::toDoubleStrict($val), 1.5));
        
        $val=1;
        $this->assertTrue(Nmbr::isEqual(Nmbr::toDoubleStrict($val), 1.0));
        
        $this->expectException(\InvalidArgumentException::class);
        $val="str";
        $result=Nmbr::toDoubleStrict($val);
    }
    
    public function testToIntStrict()
    {
        $val="1";
        $this->assertTrue(Nmbr::isEqual(Nmbr::toIntegerStrict($val), 1));
        
        $val=1;
        $this->assertTrue(Nmbr::isEqual(Nmbr::toIntegerStrict($val), 1.0));
        
        $this->expectException(\InvalidArgumentException::class);
        $val="str";
        $result=Nmbr::toIntegerStrict($val);
    }

    public function testAbs()
    {
        $this->expectException(\InvalidArgumentException::class);
        $val="str";
        $result=Nmbr::abs($val);

        $val=5;
        $result=Nmbr::abs($val);
        $this->assertEquals($result,$val);

        $val=-5;
        $result=Nmbr::abs($val);
        $this->assertEquals($result,(-1)*($val));
    }

    public function testRoundDown()
    {
        $this->assertEquals(Nmbr::roundDown(4.5),4);

        $this->assertEquals(Nmbr::roundDown(-4.5),-5);

        $this->expectException(\InvalidArgumentException::class);
        $val="str";
        $result=Nmbr::roundDown($val);
    }

    public function testRoundUp()
    {
        $this->assertEquals(Nmbr::roundUp(4.5),5);

        $this->assertEquals(Nmbr::roundUp(-4.5),-4);

        $this->expectException(\InvalidArgumentException::class);
        $val="str";
        $result=Nmbr::roundUp($val);
    }

    public function testRound()
    {
        $this->expectException(\InvalidArgumentException::class);
        Nmbr::round("str");

        $this->expectException(\InvalidArgumentException::class);
        Nmbr::round(1.5, "str");

        $this->expectException(\RangeException::class);
        Nmbr::round(1.5, 1, "str");

        $this->expectException(\RangeException::class);
        Nmbr::round(1.5, 1, -1);

        $result=Nmbr::round(1.55, 1);
        $this->aseertTrue(Nmbr::isEqual($result, 1.6));

        $result=Nmbr::round(1.555, 2);
        $this->aseertTrue(Nmbr::isEqual($result, 1.56));

        $result=Nmbr::round(1.55, 1, Nmbr::ROUND_HALF_DOWN);
        $this->aseertTrue(Nmbr::isEqual($result, 1.5));

        $result=Nmbr::round(1.555, 2, Nmbr::ROUND_HALF_DOWN);
        $this->aseertTrue(Nmbr::isEqual($result, 1.55));

        $result=Nmbr::round(1.55, 1, Nmbr::ROUND_HALF_ODD);
        $this->aseertTrue(Nmbr::isEqual($result, 1.7));

        $result=Nmbr::round(1.55, 1, Nmbr::ROUND_HALF_EVEN);
        $this->aseertTrue(Nmbr::isEqual($result, 1.6));
    }
}
