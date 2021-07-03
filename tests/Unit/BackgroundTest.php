<?php


namespace AmpedWeb\GlideUrl\Tests\Unit;




use AmpedWeb\GlideUrl\Tests\TestCase;

class BackgroundTest extends TestCase
{

    public function testBgIsFluent()
    {
        $this->assertSame($this->glideUrl, $this->glideUrl->bg('abc'));
    }

    public function testBgSetsCorrectValue()
    {
        $this->glideUrl->bg('def');
        $this->assertEquals('DEF', $this->glideUrl->getParams()['bg']);
    }

    public function testBackgroundSetsCorrectValue()
    {
        $this->glideUrl->background('0123CDEF');
        $this->assertEquals('0123CDEF', $this->glideUrl->getParams()['bg']);
    }
}