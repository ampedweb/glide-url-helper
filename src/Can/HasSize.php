<?php


namespace AmpedWeb\GlideUrl\Can;

use AmpedWeb\GlideUrl\Exceptions\InvalidFitException;
use AmpedWeb\GlideUrl\Interfaces\Fit;

/**
 * This trait exposes image sizing functionality.
 *
 * @property array $buildParams
 *
 * @link     https://glide.thephpleague.com/1.0/api/size/
 * @package AmpedWeb\GlideUrl\Can
 */
trait HasSize
{

    /**
     * Sets how the image is fitted to its target dimensions.
     *
     * @param string $option This can be any of:
     *                       - 'contain',
     *                       - 'max',
     *                       - 'fill',
     *                       - 'stretch',
     *                       - 'crop'.
     *                       There are also the handy constants on the Fit interface which are acceptable:
     *                       - Fit::CONTAIN,
     *                       - Fit::MAX,
     *                       - Fit::FILL,
     *                       - FIT::FILL_MAX,
     *                       - Fit::STRETCH,
     *                       - Fit::CROP
     *
     * @see \AmpedWeb\GlideUrl\Interfaces\Fit
     *
     * @return $this
     * @throws InvalidFitException
     */
    public function fit(string $option)
    {
        if ($option !== Fit::CONTAIN &&
            $option !== Fit::CROP &&
            $option !== Fit::FILL &&
            $option !== Fit::MAX &&
            $option !== Fit::FILL_MAX &&
            $option !== Fit::STRETCH) {
            throw new InvalidFitException();
        }


        $this->buildParams['fit'] = $option;
        return $this;
    }

    /**
     * Sets the width of the image, in pixels.
     *
     * If null, clear the width parameter.
     *
     * @param int|null $width
     *
     * @return $this
     */
    public function width(int $width = null)
    {
        $this->buildParams['w'] = $width;

        if ($width === null) {
            unset($this->buildParams['w']);
        }

        return $this;
    }

    /**
     * Sets the height of the image, in pixels.
     *
     * If null, clear the height parameter.
     *
     * @param int|null $height
     *
     * @return $this
     */
    public function height(int $height = null)
    {
        $this->buildParams['h'] = $height;

        if ($height === null) {
            unset($this->buildParams['h']);
        }

        return $this;
    }

    /**
     * Sets the width and height of the image, in pixels.
     *
     * If $width is not passed, the width Glide parameter is removed and the height parameter is set
     * If $height is not passed, the height Glide parameter is removed and the width parameter is set
     *
     * @param int|null $width
     * @param int|null $height
     *
     * @return HasSize|\AmpedWeb\GlideUrl\FluentUrlBuilder
     */
    public function size(int $width = null, int $height = null)
    {
        return $this->width($width)->height($height);
    }
}