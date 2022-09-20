<?php


namespace AmpedWeb\GlideUrl\Tests\Unit;

use AmpedWeb\GlideUrl\Exceptions\InvalidFitException;
use AmpedWeb\GlideUrl\Exceptions\InvalidMarkPositionException;
use AmpedWeb\GlideUrl\Interfaces\Fit;
use AmpedWeb\GlideUrl\Tests\TestCase;

class WatermarksTest extends TestCase
{


    public function testMarkIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->mark('foo.png'));
    }

    public function testMarkWidthIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->markWidth(45));
    }

    public function testMarkHeightIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->markHeight(50));
    }

    public function testMarkFitIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->markFit());
    }

    public function testMarkXIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->markX(45));
    }

    public function testMarkYIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->markY(45));
    }

    public function testMarkPadIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->markPad(5));
    }

    public function testMarkPosIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->markPos());
    }

    public function testMarkAlphaIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->markAlpha());
    }

    public function testMarkSetsCorrectValue()
    {
        $this->glideUrl->mark('foo.png');
        $this->assertEquals('foo.png', $this->glideUrl->getParams()['mark']);
    }

    public function testMarkWidthSetsCorrectValue()
    {
        $this->glideUrl->markWidth(10);
        $this->assertEquals(10, $this->glideUrl->getParams()['markw']);

        $this->glideUrl->markWidth('5w');
        $this->assertEquals('5w', $this->glideUrl->getParams()['markw']);
    }

    public function testMarkHeightSetsCorrectValue()
    {
        $this->glideUrl->markHeight(29);
        $this->assertEquals('29', $this->glideUrl->getParams()['markh']);

        $this->glideUrl->markHeight('70h');
        $this->assertEquals('70h', $this->glideUrl->getParams()['markh']);
    }

    public function testMarkFitSetsCorrectValue()
    {
        foreach (['contain', 'max','fill-max', 'fill', 'stretch', 'crop'] as $fit) {
            $this->glideUrl->markFit($fit);
            $this->assertEquals($fit, $this->glideUrl->getParams()['markfit']);
        }
    }

    public function testMarkFitThrowsExceptionIfInvalidParameterIsPassed()
    {
        $this->expectException(InvalidFitException::class);

        $this->glideUrl->markFit('foo');
    }

    public function testMarkXSetsCorrectValue()
    {
        $this->glideUrl->markX(5);
        $this->assertEquals(5, $this->glideUrl->getParams()['markx']);
    }

    public function testMarkYSetsCorrectValue()
    {
        $this->glideUrl->markY(9);
        $this->assertEquals(9, $this->glideUrl->getParams()['marky']);
    }

    public function testMarkPadSetsCorrectValue()
    {
        $this->glideUrl->markPad(5);
        $this->assertEquals(5, $this->glideUrl->getParams()['markpad']);
    }

    public function testMarkPosSetsCorrectValue()
    {
        foreach ([
                     'top-left',
                     'top',
                     'top-right',
                     'left',
                     'center',
                     'right',
                     'bottom-left',
                     'bottom',
                     'bottom-right'
                 ] as $position) {
            $this->glideUrl->markPos($position);
            $this->assertEquals($position, $this->glideUrl->getParams()['markpos']);
        }
    }

    public function testMarkPosThrowsExceptionIfInvalidParameterIsPassed()
    {
        $this->expectException(InvalidMarkPositionException::class);

        $this->glideUrl->markPos('foo');
    }

    public function testMarkAlphaSetsCorrectValue()
    {
        $this->glideUrl->markAlpha(45);
        $this->assertEquals(45, $this->glideUrl->getParams()['markalpha']);
    }

    public function testMarkAlphaClampsValue()
    {
        $this->glideUrl->markAlpha(-54);
        $this->assertEquals(0, $this->glideUrl->getParams()['markalpha']);

        $this->glideUrl->markAlpha(999);
        $this->assertEquals(100, $this->glideUrl->getParams()['markalpha']);
    }

    public function testMarkCanBeCleared()
    {
        $this->glideUrl->mark('foo')->mark();
        $this->assertArrayNotHasKey('mark', $this->glideUrl->getParams());
    }

    public function testMarkWidthCanBeCleared()
    {
        $this->glideUrl->markWidth(32)->markWidth();
        $this->assertArrayNotHasKey('markw', $this->glideUrl->getParams());
    }

    public function testMarkHeightCanBeCleared()
    {
        $this->glideUrl->markHeight(54)->markHeight();
        $this->assertArrayNotHasKey('markh', $this->glideUrl->getParams());
    }

    public function testMarkXCanBeCleared()
    {
        $this->glideUrl->markX(43)->markX();
        $this->assertArrayNotHasKey('markx', $this->glideUrl->getParams());
    }

    public function testMarkYCanBeCleared()
    {
        $this->glideUrl->markY(89)->markY();
        $this->assertArrayNotHasKey('marky', $this->glideUrl->getParams());
    }

    public function testMarkPadCanBeCleared()
    {
        $this->glideUrl->markPad('5w')->markPad();
        $this->assertArrayNotHasKey('markpad', $this->glideUrl->getParams());
    }
}