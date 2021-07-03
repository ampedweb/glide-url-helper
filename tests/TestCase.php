<?php

namespace AmpedWeb\GlideUrl\Tests;

use AmpedWeb\GlideUrl\FluentUrlBuilder;
use League\Glide\Urls\UrlBuilderFactory;

class TestCase extends \PHPUnit\Framework\TestCase
{

    /**
     * @var FluentUrlBuilder
     */
    protected FluentUrlBuilder $glideUrl;

    protected function setUp():void {

        $signatureKey =  'v-LK4WCdhcfcc%jt*VC2cj%nVpu+xQKvLUA%H86kRVk_4bgG8&CWM#k*b_7MUJpmTc=4GFmKFp7=K%67je-skxC5vz+r#xT?62tT?Aw%FtQ4Y3gvnwHTwqhxUh89wCa_';
        $baseUrl = '/img/';

        $urlBuilder = UrlBuilderFactory::create(
            $baseUrl,
            $signatureKey
        );

        $this->glideUrl = (new FluentUrlBuilder($urlBuilder))->setPath('foo.png');

    }
}