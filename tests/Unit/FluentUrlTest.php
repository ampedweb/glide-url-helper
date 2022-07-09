<?php

namespace AmpedWeb\GlideUrl\Tests\Unit;

use AmpedWeb\GlideUrl\Interfaces\Border;
use AmpedWeb\GlideUrl\Interfaces\Filter;
use AmpedWeb\GlideUrl\Interfaces\Fit;
use AmpedWeb\GlideUrl\Interfaces\Rotate;
use AmpedWeb\GlideUrl\Tests\TestCase;

class FluentUrlTest extends TestCase
{

    public function testPresetsMethod()
    {
        $this->glideUrl->preset('small', ['w' => 100]);

        $this->assertEquals('small', $this->glideUrl->getParams()['p']);
        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
    }

    public function testPresetsMethodWitjArrau()
    {
        $presetArray = ['small', 'large'];

        $this->glideUrl->preset($presetArray, ['w' => 100]);

        $this->assertEquals('small,large', $this->glideUrl->getParams()['p']);

        $this->assertEquals(100, $this->glideUrl->getParams()['w']);
    }

    public function testBuildMethodIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->build());
        $this->assertEmpty($this->glideUrl->getParams());
    }

    public function testCustomMethod()
    {
        $customArray = ['w' => 40, 'h' => 40, 'fm' => 'webp'];
        $expectedPath = '/img/foo.png';

        $customUrl = $this->glideUrl->custom($customArray);

        $this->assertIsString($customUrl);

        //Parse the URL query string into an array
        $parsedUrl = parse_url($customUrl);
        parse_str($parsedUrl['query'], $queryParams);

        //Check query params match
        foreach ($customArray as $paramKey => $paramVal) {
            $this->assertEquals($paramVal, $queryParams[$paramKey]);
        }

        //Check base path matches
        $this->assertEquals($parsedUrl['path'], $expectedPath);
    }

    public function testUrlMethod()
    {
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


    public function testPathClosure()
    {
        $this->glideUrl->setPathClosure(function ($path) {
            return 'bar' . $path;
        });

        $this->assertEquals('barfoo.png', $this->glideUrl->getPath());
    }

    public function testUrlClosure()
    {
        $this->glideUrl->setUrlClosure(function ($url) {
            return 'bar' . $url;
        });

        $urlParsed = parse_url($this->glideUrl->url());

        $this->assertNotFalse(strpos($urlParsed['path'], 'bar'));
    }

    public function testStringCast()
    {
        $this->glideUrl->setPath('foo');

        $this->assertEquals('/img/foo?s=7af3bd98ffed0ef0d402c2d33bd88b43', (string)$this->glideUrl);
    }

    public function testSubsequentOptionsOverrideExistingOnes()
    {
        // Source Filename
        $foo = $this->glideUrl->setPath('foo');
        $this->assertStringContainsString('/img/foo', $foo->url());

        $foo->setPath('bar');
        $this->assertStringContainsString('/img/bar', $foo);

        // Fit
        $foo->fit(Fit::CONTAIN);
        $this->assertEquals(Fit::CONTAIN, $foo->getParams()['fit']);

        $foo->fit(Fit::CROP);
        $this->assertEquals(Fit::CROP, $foo->getParams()['fit']);

        // Encoding
        $foo->jpeg(50);
        $this->assertEquals('jpg', $foo->getParams()['fm']);
        $this->assertEquals(50, $foo->getParams()['q']);

        $foo->png();
        $this->assertEquals('png', $foo->getParams()['fm']);
        $this->assertArrayNotHasKey('q', $foo->getParams());

        // Adjustments
        $foo->bri(1)->con(2)->gam(0.3)->sharp(4);
        $this->assertEquals(1, $foo->getParams()['bri']);
        $this->assertEquals(2, $foo->getParams()['con']);
        $this->assertEquals(0.3, $foo->getParams()['gam']);
        $this->assertEquals(4, $foo->getParams()['sharp']);

        $foo->bri(4)->con(3)->gam(0.2)->sharp(1);
        $this->assertEquals(4, $foo->getParams()['bri']);
        $this->assertEquals(3, $foo->getParams()['con']);
        $this->assertEquals(0.2, $foo->getParams()['gam']);
        $this->assertEquals(1, $foo->getParams()['sharp']);

        $foo->bri(2)->con(4)->gam(0.6)->sharp(8)->bri(3)->con(6)->gam(0.9);
        $this->assertEquals(3, $foo->getParams()['bri']);
        $this->assertEquals(6, $foo->getParams()['con']);
        $this->assertEquals(0.9, $foo->getParams()['gam']);
        $this->assertEquals(8, $foo->getParams()['sharp']);

        // Background
        $foo->bg('abc')->bg('def');
        $this->assertEquals('DEF', $foo->getParams()['bg']);

        // Border
        $foo->border(3, 'abc')->border(8, 'f00');
        $this->assertEquals(
            sprintf('%s,%s,%s', 8, 'F00', Border::OVERLAY),
            $this->glideUrl->getParams()['border']
        );

        // Crop
        $foo->crop(50, 50)->crop(25,75);
        $this->assertEquals(25, $foo->getParams()['w']);
        $this->assertEquals(75, $foo->getParams()['h']);
        $this->assertEquals(Fit::CROP, $foo->getParams()['fit']);

        $foo->crop(12, 34)->fit(Fit::CONTAIN)->width(150)->height();
        $this->assertEquals(150, $foo->getParams()['w']);
        $this->assertEquals(Fit::CONTAIN, $foo->getParams()['fit']);
        $this->assertArrayNotHasKey('h', $foo->getParams());

        // Width/Height/Size
        $foo->width(25)->height(25)->width();
        $this->assertEquals(25, $foo->getParams()['h']);
        $this->assertArrayNotHasKey('w', $foo->getParams());

        $foo->width(100)->height(200)->size(45);
        $this->assertEquals(45, $foo->getParams()['w']);
        $this->assertArrayNotHasKey('h', $foo->getParams());


        // Effects
        // Blur
        $foo->blur(25)->blur();
        $this->assertEquals(0, $foo->getParams()['blur']);

        // Pixel
        $foo->pixel(25)->pixel();
        $this->assertEquals(0, $foo->getParams()['pixel']);

        // Filt
        $foo->filt(Filter::GREYSCALE)->filter(Filter::SEPIA);
        $this->assertEquals(Filter::SEPIA, $foo->getParams()['filt']);

        // Orientation
        $foo->orientation(Rotate::AUTO)->orientation(Rotate::R270);
        $this->assertEquals(Rotate::R270, $foo->getParams()['or']);

        // DPR
        $foo->dpr(5)->dpr(1);
        $this->assertEquals(1, $foo->getParams()['dpr']);

        // Watermarks
        $foo->mark('bar')->mark('baz');
        $this->assertEquals('baz', $foo->getParams()['mark']);

        $foo->markX(5)->markX(2);
        $this->assertEquals(2, $foo->getParams()['markx']);

        $foo->markY(8)->markY(4);
        $this->assertEquals(4, $foo->getParams()['marky']);

        $foo->markAlpha(30)->markAlpha(75);
        $this->assertEquals(75, $foo->getParams()['markalpha']);

        $foo->markFit(Fit::CROP)->markFit(Fit::CONTAIN);
        $this->assertEquals(Fit::CONTAIN, $foo->getParams()['markfit']);

        $foo->markPad('3w')->markPad('4h');
        $this->assertEquals('4h', $foo->getParams()['markpad']);

        $foo->markWidth(30)->markWidth(60);
        $this->assertEquals(60, $foo->getParams()['markw']);

        $foo->markHeight(20)->markHeight(50);
        $this->assertEquals(50, $foo->getParams()['markh']);
    }

    public function testCloningAGlideUrl()
    {
        $foo = $this->glideUrl->setPath('foo')->width(45)->fit(Fit::CONTAIN)->jpeg();
        $bar = $foo->clone()->png()->width(120);

        $this->assertNotEmpty($bar, $foo);

        $this->assertEquals('png', $bar->getParams()['fm']);
        $this->assertEquals(120, $bar->getParams()['w']);

        $this->assertEquals('jpg', $foo->getParams()['fm']);
        $this->assertEquals(45, $foo->getParams()['w']);
    }
}