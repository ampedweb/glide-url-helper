<?php


namespace AmpedWeb\GlideUrl\Tests\Unit;

use AmpedWeb\GlideUrl\Exceptions\InvalidFilterException;
use AmpedWeb\GlideUrl\Interfaces\Filter;
use AmpedWeb\GlideUrl\Tests\TestCase;

class EffectsTest extends TestCase
{

    public function testBlurIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->blur(30));
    }

    public function testPixelIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->pixel(30));
    }

    public function testFiltIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->filt('greyscale'));
    }

    public function testFiltCanBeRemoved()
    {
        $this->glideUrl->filt(Filter::GREYSCALE)->filt();

        $this->assertArrayNotHasKey('filt', $this->glideUrl->getParams());
    }

    public function testBlurSetsCorrectValues()
    {
        $this->glideUrl->blur(45);
        $this->assertEquals(45, $this->glideUrl->getParams()['blur']);
    }

    public function testPixelSetsCorrectValues()
    {
        $this->glideUrl->pixel(995);
        $this->assertEquals(995, $this->glideUrl->getParams()['pixel']);
    }

    public function testFiltSetsCorrectValues()
    {
        $this->glideUrl->filt(Filter::SEPIA);
        $this->assertEquals(Filter::SEPIA, $this->glideUrl->getParams()['filt']);
    }

    public function testBlurFlattensOutOfRangeValues()
    {
        $this->glideUrl->blur(-999);
        $this->assertEquals(0, $this->glideUrl->getParams()['blur']);

        $this->glideUrl->blur(999);
        $this->assertEquals(100, $this->glideUrl->getParams()['blur']);
    }

    public function testPixelFlattensOutOfRangeValues()
    {
        $this->glideUrl->pixel(-999);
        $this->assertEquals(0, $this->glideUrl->getParams()['pixel']);

        $this->glideUrl->pixel(9999);
        $this->assertEquals(1000, $this->glideUrl->getParams()['pixel']);
    }

    public function testFiltThrowsExceptionIfInvalidParameterIsPassed()
    {
        $this->expectException(InvalidFilterException::class);

        $this->glideUrl->filt('foo');
    }

    public function testPixelateIsAliasOfPixel()
    {
        $this->assertSame($this->glideUrl->pixelate(45), $this->glideUrl->pixel(45));
    }

    public function testFilterIsAliasOfFilt()
    {
        $this->assertSame($this->glideUrl->filter(Filter::SEPIA),
                          $this->glideUrl->filt(Filter::SEPIA));
    }
}