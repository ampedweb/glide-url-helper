<?php


namespace AmpedWeb\GlideUrl\Tests\Unit;

use AmpedWeb\GlideUrl\Tests\TestCase;

class EncodeTest extends TestCase
{

//@todo Refactor Encode tests

    public function testGifSetsCorrectValue()
    {
        $this->glideUrl->gif(50);
        $this->assertEquals('gif', $this->glideUrl->getParams()['fm']);
        $this->assertEquals(50, $this->glideUrl->getParams()['q']);
    }

    public function testJpgSetsCorrectValue()
    {
        $this->glideUrl->jpeg(50);
        $this->assertEquals('jpg', $this->glideUrl->getParams()['fm']);
        $this->assertEquals(50, $this->glideUrl->getParams()['q']);
    }


    public function testPjpgSetsCorrectValue()
    {
        $this->glideUrl->pjpeg(50);
        $this->assertEquals('pjpg', $this->glideUrl->getParams()['fm']);
        $this->assertEquals(50, $this->glideUrl->getParams()['q']);
    }

    public function testPngSetsCorrectValue()
    {
        $this->glideUrl->png(50);
        $this->assertEquals('png', $this->glideUrl->getParams()['fm']);
        $this->assertEquals(50, $this->glideUrl->getParams()['q']);
    }


    public function testWebPSetsCorrectValue()
    {
        $this->glideUrl->webp(50);
        $this->assertEquals('webp', $this->glideUrl->getParams()['fm']);
        $this->assertEquals(50, $this->glideUrl->getParams()['q']);
    }

    public function testAvifSetsCorrectValue()
    {
        $this->glideUrl->avif(50);
        $this->assertEquals('avif', $this->glideUrl->getParams()['fm']);
        $this->assertEquals(50, $this->glideUrl->getParams()['q']);
    }

    public function testQualityIsClearedWhenNotExplicitlyPassed()
    {
        $this->glideUrl->jpeg(50);
        $this->assertEquals(50, $this->glideUrl->getParams()['q']);

        $this->glideUrl->jpeg();
        $this->assertArrayNotHasKey('q', $this->glideUrl->getParams());
    }

//    public function testGif()
//    {
//        $response = $this->get(glide_url('cat.png')->build()->gif()->url());
//
//        $response->assertHeader('content-type', 'image/gif');
//        $response->assertOk();
//
//        /*
//         * GIF Files start with "GIF89a"
//         */
//        $identifyingBytes = substr($response->streamedContent(), 0, 6);
//
//        $this->assertEquals('GIF89a', $identifyingBytes);
//    }
//
//    public function testJpeg()
//    {
//        $response = $this->get(glide_url('cat.png')->build()->jpeg()->url());
//
//        $response->assertHeader('content-type', 'image/jpeg');
//        $response->assertOk();
//
//        /*
//         * JPEG Files start with 0xFF 0xD8 0xFF
//         */
//        $identifyingBytes = substr($response->streamedContent(), 0, 3);
//        $jpegIdentifier = chr(0xFF).chr(0xD8).chr(0xFF);
//
//        $this->assertEquals($jpegIdentifier, $identifyingBytes);
//    }
//
//    public function testPjpeg()
//    {
//        $response = $this->get(glide_url('cat.png')->build()->pjpeg()->url());
//
//        $response->assertHeader('content-type', 'image/jpeg');
//        $response->assertOk();
//
//        /*
//         * JPEG Files start with 0xFF 0xD8 0xFF
//         */
//        $identifyingBytes = substr($response->streamedContent(), 0, 3);
//        $jpegIdentifier = chr(0xFF).chr(0xD8).chr(0xFF);
//
//        $this->assertEquals($jpegIdentifier, $identifyingBytes);
//    }
//
//    public function testPng()
//    {
//        $response = $this->get(glide_url('cat.png')->build()->png()->url());
//
//        $response->assertHeader('content-type', 'image/png');
//        $response->assertOk();
//
//        /*
//         * PNG Files start with 0x89 0x50 0x4E 0x47 0x0D 0x0A 0x1A 0x0A
//         */
//        $identifyingBytes = substr($response->streamedContent(), 0, 8);
//        $pngIdentifier = chr(0x89).chr(0x50).chr(0x4E).chr(0x47).chr(0x0D).chr(0x0A).chr(0x1A).chr(0x0A);
//
//        $this->assertEquals($pngIdentifier, $identifyingBytes);
//    }
//
//    public function testWebp()
//    {
//        $response = $this->get(glide_url('cat.png')->build()->webp()->url());
//
//        $response->assertHeader('content-type', 'image/webp');
//        $response->assertOk();
//
//        /*
//         * WebP Files have "RIFF" in bytes 0-3, "WEBP" in bytes 8-11 and "VP8" in bytes 12-14
//         */
//
//        $content = $response->streamedContent();
//
//        $firstIdentifyingBytes = substr($content, 0, 4);
//        $secondIdentifyingBytes = substr($content, 8, 4);
//        $thirdIdentifyingBytes = substr($content, 12, 3);
//
//        $this->assertEquals('RIFF', $firstIdentifyingBytes);
//        $this->assertEquals('WEBP', $secondIdentifyingBytes);
//        $this->assertEquals('VP8', $thirdIdentifyingBytes);
//    }
//
//    public function testQuality()
//    {
//        $desiredQuality = 45;
//
//        $glideBuilder = glide_url('cat.png')->build()->jpeg($desiredQuality);
//
//        $this->assertEquals($desiredQuality, $glideBuilder->getParams()['q']);
//    }
}