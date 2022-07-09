<?php


namespace AmpedWeb\GlideUrl\Tests\Unit;



use AmpedWeb\GlideUrl\Exceptions\InvalidFitException;
use AmpedWeb\GlideUrl\Interfaces\Fit;
use AmpedWeb\GlideUrl\Tests\TestCase;

class SizeTest extends TestCase
{

    public function testFitRejectsInvalidInput()
    {
        $this->expectException(InvalidFitException::class);
        $this->glideUrl->fit('foo');
    }

    public function testFitSetsCorrectContainValue()
    {
        $this->glideUrl->fit(Fit::CONTAIN);
        $this->assertEquals('contain', $this->glideUrl->getParams()['fit']);
    }

    public function testFitSetsCorrectMaxValue()
    {
        $this->glideUrl->fit(Fit::MAX);
        $this->assertEquals('max', $this->glideUrl->getParams()['fit']);
    }

    public function testFitSetsCorrectFillValue()
    {
        $this->glideUrl->fit(Fit::FILL);
        $this->assertEquals('fill', $this->glideUrl->getParams()['fit']);
    }

    public function testFitSetsCorrectStretchValue()
    {
        $this->glideUrl->fit(Fit::STRETCH);
        $this->assertEquals('stretch', $this->glideUrl->getParams()['fit']);
    }

    public function testFitSetsCorrectCropValue()
    {
        $this->glideUrl->fit(Fit::CROP);
        $this->assertEquals('crop', $this->glideUrl->getParams()['fit']);
    }

    public function testFitIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->fit(Fit::CROP));
    }

    public function testWidthSetsCorrectValue()
    {
        $this->glideUrl->width(50);
        $this->assertEquals(50, $this->glideUrl->getParams()['w']);

        $this->glideUrl->width();
        $this->assertArrayNotHasKey('w', $this->glideUrl->getParams());
    }

    public function testWidthIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->width(50));
    }

    public function testHeightSetsCorrectValue()
    {
        $this->glideUrl->height(100);
        $this->assertEquals(100, $this->glideUrl->getParams()['h']);

        $this->glideUrl->height();
        $this->assertArrayNotHasKey('h', $this->glideUrl->getParams());
    }

    public function testHeightIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->height(100));
    }

    public function testSizeSetsCorrectValues()
    {
        $this->glideUrl->size(320,240);
        $this->assertEquals(320, $this->glideUrl->getParams()['w']);
        $this->assertEquals(240, $this->glideUrl->getParams()['h']);

        $this->glideUrl->size(null, 25);
        $this->assertArrayNotHasKey('w', $this->glideUrl->getParams());
        $this->assertEquals(25, $this->glideUrl->getParams()['h']);

        $this->glideUrl->size(25);
        $this->assertArrayNotHasKey('h', $this->glideUrl->getParams());
        $this->assertEquals(25, $this->glideUrl->getParams()['w']);
    }

    public function testSizeIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->size(320, 240));
    }
}