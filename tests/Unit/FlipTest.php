<?php


namespace AmpedWeb\GlideUrl\Tests\Unit;

use AmpedWeb\GlideUrl\Exceptions\InvalidFlipException;
use AmpedWeb\GlideUrl\Interfaces\Flip;
use AmpedWeb\GlideUrl\Tests\TestCase;

class FlipTest extends TestCase
{

    public function testFlipRejectsInvalidInput()
    {
        $invalidInput = 'foo';
        $this->expectException(InvalidFlipException::class);
        $this->glideUrl->flip($invalidInput);
    }

    public function testFlipSetsCorrectValueV()
    {
        $this->glideUrl->flip(Flip::VERTICAL);
        $this->assertEquals('v', $this->glideUrl->getParams()['flip']);
    }

    public function testFlipSetsCorrectValueH()
    {
        $this->glideUrl->flip(Flip::HORIZONTAL);
        $this->assertEquals('h', $this->glideUrl->getParams()['flip']);
    }

    public function testFlipSetsCorrectValueBoth()
    {
        $this->glideUrl->flip(Flip::BOTH);
        $this->assertEquals('both', $this->glideUrl->getParams()['flip']);
    }
}