<?php

namespace AmpedWeb\GlideUrl\Tests\Unit;

use AmpedWeb\GlideUrl\Tests\TestCase;

class FluentUrlTest extends TestCase
{

    public function testPresetsMethod() {

        $this->glideUrl->preset('small',['w'=>100]);

        $this->assertEquals('small', $this->glideUrl->getParams()['p']);
        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
    }

    public function testPresetsMethodWitjArrau() {

        $presetArray = ['small','large'];

        $this->glideUrl->preset($presetArray,['w'=>100]);

        $this->assertEquals('small,large',$this->glideUrl->getParams()['p']);

        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
    }

    public function testBuildMethodIsFluent() {
        $this->assertEquals($this->glideUrl,$this->glideUrl->build());
        $this->assertEmpty($this->glideUrl->getParams());
    }

    public function testCustomMethod() {

        $customArray = ['w'=>40,'h'=>40,'fm'=>'webp'];
        $expectedPath = '/img/foo.png';

        $customUrl = $this->glideUrl->custom($customArray);

        $this->assertIsString($customUrl);

        //Parse the URL query string into an array
        $parsedUrl = parse_url($customUrl);
        parse_str($parsedUrl['query'],$queryParams);

        //Check query params match
        foreach ($customArray as $paramKey => $paramVal) {
            $this->assertEquals($paramVal,$queryParams[$paramKey]);
        }

        //Check base path matches
        $this->assertEquals($parsedUrl['path'],$expectedPath);

    }

    public function testUrlMethod() {

        $url = $this->glideUrl->width(40)->height(50)->fit('crop')->webp()->url();

        $this->assertIsString($url);

    }

    public function testSetAndGetPath()
    {
        $path = 'foo.png';
        $this->glideUrl->setPath($path);
        $this->assertEquals($path, $this->glideUrl->getPath());
    }

    public function testBuiltParamsArrayIsInitialised()
    {
        $this->assertIsArray($this->glideUrl->getParams());
    }


    public function testPathClosure() {

        $this->glideUrl->setPathClosure(function($path) {
            return 'bar'.$path;
        });

        $this->assertEquals('barfoo.png',$this->glideUrl->getPath());

    }

    public function testUrlClosure() {

        $this->glideUrl->setUrlClosure(function($url) {
            return 'bar'.$url;
        });

        $urlParsed = parse_url($this->glideUrl->url());

        $this->assertNotFalse(strpos($urlParsed['path'],'bar'));

    }

    public function testStringCast()
    {
        $this->glideUrl->setPath('foo');

        $this->assertEquals('/img/foo?s=7af3bd98ffed0ef0d402c2d33bd88b43', (string)$this->glideUrl);
    }
}