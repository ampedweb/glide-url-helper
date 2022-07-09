<?php


namespace AmpedWeb\GlideUrl\Can;


use AmpedWeb\GlideUrl\FluentUrlBuilder;

/**
 * Trait Encode
 *
 * @property array $buildParams
 *
 * @see https://glide.thephpleague.com/1.0/api/encode/
 * @package AmpedWeb\GlideUrl\Can
 */
trait HasEncode
{
    /**
     * Encode the image to GIF
     *
     * @param int|null $quality
     *
     * @return FluentUrlBuilder|HasEncode
     */
    public function gif(int $quality = null)
    {
        $this->buildParams['fm'] = 'gif';
        return $this->quality($quality);
    }

    /**
     * Encode the image to JPEG
     *
     * @param int|null $quality
     *
     * @return FluentUrlBuilder|HasEncode
     */
    public function jpeg(int $quality = null)
    {
        $this->buildParams['fm'] = 'jpg';
        return $this->quality($quality);
    }

    /**
     * Encode the image to Progressive JPEG
     *
     * @param int|null $quality
     *
     * @return FluentUrlBuilder|HasEncode
     */
    public function pjpeg(int $quality = null)
    {
        $this->buildParams['fm'] = 'pjpg';
        return $this->quality($quality);
    }

    /**
     * Encode the image to PNG
     *
     * @param int|null $quality
     *
     * @return FluentUrlBuilder|HasEncode
     */
    public function png(int $quality = null)
    {
        $this->buildParams['fm'] = 'png';
        return $this->quality($quality);
    }

    /**
     * Encode the image to WebP
     *
     * @param int|null $quality
     *
     * @return FluentUrlBuilder|HasEncode
     */
    public function webp(int $quality = null)
    {
        $this->buildParams['fm'] = 'webp';
        return $this->quality($quality);
    }

    /**
     * Defines the quality of the image.  Use values between 0 and 100.
     *
     * @param int|null $quality
     *
     * @return FluentUrlBuilder|HasEncode
     */
    public function quality(int $quality = null)
    {
        unset($this->buildParams['q']);

        if ($quality !== null) {
            $this->buildParams['q'] = $quality;
        }

        return $this;
    }
}