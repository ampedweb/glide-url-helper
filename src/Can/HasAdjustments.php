<?php


namespace AmpedWeb\GlideUrl\Can;

use AmpedWeb\GlideUrl\FluentUrlBuilder;

/**
 * Exposes image "adjustments" functionality
 *
 * @link    https://glide.thephpleague.com/1.0/api/adjustments/
 * @package AmpedWeb\GlideUrl\Can
 */
trait HasAdjustments
{
    /**
     * @property array $buildParams
     */

    /**
     * Adjusts the image brightness. Use values between -100 and +100, where 0 represents no change.
     *
     * @param int $brightness Brightness - use values between 0 and 100
     *
     * @return $this;
     */
    public function bri(int $brightness = 0)
    {
        $brightness = max($brightness, -100);
        $brightness = min($brightness, 100);

        $this->buildParams['bri'] = $brightness;
        return $this;
    }

    /**
     * Adjusts the image brightness.  Use values between -100 and +100, where 0 represents no change.
     *
     * @param int $brightness Brightness - use values between 0 and 100
     *
     * @return HasAdjustments|FluentUrlBuilder
     * @see HasAdjustments::bri()
     */
    public function brightness(int $brightness = 0)
    {
        return $this->bri($brightness);
    }

    /**
     * Adjusts the image contrast. Use values between -100 and +100, where 0 represents no change.
     *
     * @param int $contrast Contrast - use values between 0 and 100
     *
     * @return $this;
     */
    public function con(int $contrast = 0)
    {
        $contrast = max($contrast, -100);
        $contrast = min($contrast, 100);

        $this->buildParams['con'] = $contrast;
        return $this;
    }

    /**
     * Adjusts the image contrast. Use values between -100 and +100, where 0 represents no change.
     *
     * @param int $contrast Contrast - use values between 0 and 100
     *
     * @return HasAdjustments|FluentUrlBuilder
     * @see HasAdjustments::con()
     */
    public function contrast(int $contrast = 0)
    {
        return $this->con($contrast);
    }

    /**
     * Adjusts the image gamma. Use values between 0.1 and 9.99.
     *
     * @param float $gamma Gamma - use values between 0.1 and 9.99
     *
     * @return $this
     */
    public function gam(float $gamma = 1.0)
    {
        $gamma = max($gamma, 0.1);
        $gamma = min($gamma, 9.99);

        $this->buildParams['gam'] = $gamma;
        return $this;
    }

    /**
     * Adjusts the image gamma. Use values between 0.1 and 9.99.
     *
     * @param float $gamma Gamma - use values between 0.1 and 9.99
     *
     * @return HasAdjustments|FluentUrlBuilder
     * @see HasAdjustments::gam()
     */
    public function gamma(float $gamma = 1.0)
    {
        return $this->gam($gamma);
    }

    /**
     * Sharpen the image. Use values between 0 and 100.
     *
     * @param int $sharpness Shaprness - use values between 0 and 100
     *
     * @return $this
     */
    public function sharp(int $sharpness = 0)
    {
        $sharpness = max($sharpness, 0);
        $sharpness = min($sharpness, 100);

        $this->buildParams['sharp'] = $sharpness;
        return $this;
    }

    /**
     * Sharpen the image. Use values between 0 and 100.
     *
     * @param int $sharpness Shaprness - use values between 0 and 100
     *
     * @return HasAdjustments|FluentUrlBuilder
     * @see HasAdjustments::sharp()
     */
    public function sharpen(int $sharpness = 0)
    {
        return $this->sharp($sharpness);
    }
}