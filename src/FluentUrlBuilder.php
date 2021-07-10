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
use Closure;
use League\Glide\Urls\UrlBuilder;

class FluentUrlBuilder
{
    use HasOrientation, HasFlip, HasCrop, HasSize, HasPixelDensity, HasAdjustments, HasEffects, HasBorder, HasWatermarks, HasBackground, HasEncode;

    /**
     * The filepath of our image being manipulated
     * @var string
     */
    protected $path;

    /**
     * @var UrlBuilder
     */
    protected $urlBuilder;

    /**
     * @var array
     */
    protected $buildParams;


    /**
     * @var Closure|null
     */
    protected $pathClosure = null;

    /**
     * @var Closure|null
     */
    protected $urlClosure = null;

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
     * @return FluentUrlBuilder
     */
    public function setPath(string $path): FluentUrlBuilder
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param Closure $pathClosure
     *
     * @return FluentUrlBuilder
     */
    public function setPathClosure(Closure $pathClosure): FluentUrlBuilder
    {
        $this->pathClosure = $pathClosure;
        return $this;
    }

    /**
     * @param Closure $urlClosure
     *
     * @return FluentUrlBuilder
     */
    public function setUrlClosure(Closure $urlClosure): FluentUrlBuilder
    {
        $this->urlClosure = $urlClosure;
        return $this;
    }


    /**
     * @return string
     */
    public function getPath():string {

        $pathClosure = $this->pathClosure;

        if($pathClosure instanceof Closure) {
            return $pathClosure($this->path);
        }

        return $this->path;

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
     * @return FluentUrlBuilder
     */
    public function preset($presets, array $params = []): FluentUrlBuilder
    {
        $this->buildParams = array_merge($this->parsePresets($presets), $params);
        return $this;
    }


    /**
     * @param $path
     * @param $params
     *
     * @return string
     */
    protected function buildUrl($path,$params): string
    {

        $url = $this->urlBuilder->getUrl($path, $params);

        $urlClosure = $this->urlClosure;

        if($urlClosure instanceof Closure) {
            return $urlClosure($url);
        }

        return $url;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function custom(array $params = []): string
    {
        return $this->buildUrl($this->getPath(),$params);
    }


    /*
     * Fluent Interface Functions
     */


    /**
     * Start building an image configuration
     *
     * @return $this
     */
    public function build(): FluentUrlBuilder
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
        return $this->buildUrl($this->getPath(), $this->buildParams);
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