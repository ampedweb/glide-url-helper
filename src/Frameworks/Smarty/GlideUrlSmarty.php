<?php

namespace AmpedWeb\GlideUrl\Frameworks\Smarty;

use AmpedWeb\GlideUrl\FluentUrlBuilder;
use League\Glide\Urls\UrlBuilder;

class GlideUrlSmarty
{

    /**
     * @var UrlBuilder
     */
    protected UrlBuilder $urlBuilder;

    /**
     * GlideUrlSmarty constructor.
     *
     * @param UrlBuilder $urlBuilder
     */
    public function __construct(UrlBuilder $urlBuilder)
    {
        $this->urlBuilder = $urlBuilder;
    }

    public function path($path)
    {
        if ($path === null) {
            return '';
        }

        return (new FluentUrlBuilder($this->urlBuilder))->setPath($path);
    }
}