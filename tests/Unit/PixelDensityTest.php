<?php


namespace AmpedWeb\GlideInABox\Tests\Feature;



use AmpedWeb\GlideUrl\Tests\TestCase;

class PixelDensityTest extends TestCase
{

    public function testDprIsFluent()
    {
        $this->assertEquals($this->glideUrl, $this->glideUrl->dpr(1));
    }

    public function testDprSetsCorrectValue()
    {
        $this->glideUrl->dpr(4);
        $this->assertEquals(4, $this->glideUrl->getParams()['dpr']);
    }

    public function testDprFlattensMinimumValue()
    {
        $this->glideUrl->dpr(0);
        $this->assertEquals(1, $this->glideUrl->getParams()['dpr']);
    }

    public function testDprFlattensMaximumValue()
    {
        $this->glideUrl->dpr(9);
        $this->assertEquals(8, $this->glideUrl->getParams()['dpr']);
    }
}