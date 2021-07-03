<?php

namespace AmpedWeb\GlideUrl;

use AmpedWeb\GlideUrl\Can\HasAdjustments;
use AmpedWeb\GlideUrl\Can\HasBackground;
use AmpedWeb\GlideUrl\Can\HasBorder;
use AmpedWeb\GlideUrl\Can\HasCrop;
use AmpedWeb\GlideUrl\Can\HasEffects;
use AmpedWeb\GlideUrl\Can\HasEncode;
use AmpedWeb\GlideUrl\Can\HasFlip;
use AmpedWeb\GlideUrl\Can\HasOrientation;
use AmpedWeb\GlideUrl\Can\HasPixelDensity;
use AmpedWeb\GlideUrl\Can\HasSize;
use AmpedWeb\GlideUrl\Can\HasWatermarks;
use League\Glide\Urls\UrlBuilder;

class GlideUrl
{
    use HasOrientation, HasFlip, HasCrop, HasSize, HasPixelDensity, HasAdjustments, HasEffects, HasBorder, HasWatermarks, HasBackground, HasEncode;

    /**
     * The filepath of our image being manipulated
     * @var string
     */
    protected string $path;

    /**
     * @var UrlBuilder
     */
    protected UrlBuilder $urlBuilder;

    /**
     * @var array
     */
    protected array $buildParams;

    /**
     * GlideUrl constructor.
     */
    public function __construct(UrlBuilder $urlBuilder)
    {
        $this->urlBuilder = $urlBuilder;
        $this->buildParams = [];
    }


    /**
     * @param string $path
     *
     * @return GlideUrl
     */
    public function setPath(string $path): GlideUrl
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Parse either single or multiple presets
     *
     * @param $presets
     *
     * @return array
     */
    protected function parsePresets($presets): array
    {

        if (is_array($presets)) {
            return ['p' => implode(',', $presets)];
        }

        return ['p' => $presets];

    }

    /**
     * Start building an image URL based on a preset
     *
     * @param       $presets
     * @param array $params
     *
     * @return GlideUrl
     */
    public function preset($presets, array $params = []): GlideUrl
    {
        $this->buildParams = array_merge($this->parsePresets($presets), $params);
        return $this;
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function custom(array $params = [])
    {

        return $this->urlBuilder->getUrl($this->path, $params);
    }

    /*
     * Fluent Interface Functions
     */


    /**
     * Start building an image configuration
     *
     * @return $this
     */
    public function build(): GlideUrl
    {
        $this->buildParams = [];

        return $this;
    }

    /**
     * Get the URL to your image after building the configuration
     *
     * @return string
     */
    public function url(): string
    {
        return $this->urlBuilder->getUrl($this->path, $this->buildParams);
    }

    /**
     * Get the current set of image builder parameters
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->buildParams;
    }
}