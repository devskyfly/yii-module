<?php
namespace devskyfly\php56\libs;

class UrlTest extends \Codeception\Test\Unit
{
    // tests
    public function testGenerateQuery()
    {
        $data = [
            "a" => "str1",
            "b" => "str2"
        ];
        $result = Url::generateQuery($data);
        $this->assertEquals($result,"a=str1&b=str2");
        
        $data[]="str3";
        $data[]="str4";

        $result = Url::generateQuery($data, 'skyfly_');
        $this->assertEquals($result, "a=str1&b=str2&skyfly_0=str3&skyfly_1=str4");

        $result = Url::generateQuery($data, 'skyfly_', "#");
        $this->assertEquals($result, "a=str1#b=str2#skyfly_0=str3#skyfly_1=str4");

        $this->expectException(\InvalidArgumentException::class);
        $result = Url::generateQuery($data, 1);

        $this->expectException(\InvalidArgumentException::class);
        $result = Url::generateQuery($data, "skyfly_", 1);
    }

    public function testParseQuery()
    {
        $url = "http://username:password@devskyfly.com:3000/api/rates/get?id=1&val=2#token";
        $result = Url::parseQuery($url);

        $this->assertEquals($result['scheme'], 'http');
        $this->assertEquals($result['host'], 'devskyfly.com');
        $this->assertEquals($result['port'], '3000');
        $this->assertEquals($result['user'], 'username');
        $this->assertEquals($result['pass'], 'password');
        $this->assertEquals($result['path'], '/api/rates/get');
        $this->assertEquals($result['query'], 'id=1&val=2');
        $this->assertEquals($result['fragment'], 'token');
    }
}