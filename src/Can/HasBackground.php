<?php


namespace AmpedWeb\GlideUrl\Can;

use AmpedWeb\GlideUrl\Exceptions\InvalidColourException;
use AmpedWeb\GlideUrl\GlideUrl;

/**
 * This trait provides background-related functionality
 *
 * @package AmpedWeb\GlideUrl\Can
 *
 * @link    https://glide.thephpleague.com/1.0/api/background/
 */
trait HasBackground
{
    /**
     * @property array $buildParams
     */

    use HasColourParser;

    /**
     * Sets the background color of the image.
     *
     * See colors {@link https://glide.thephpleague.com/1.0/api/background/} for more information on the available
     * color formats.
     *
     * @param string $colour
     *
     * @return $this
     * @throws InvalidColourException
     */
    public function bg(string $colour)
    {
        $this->buildParams['bg'] = $this->parseColour($colour);

        return $this;
    }

    /**
     * Sets the background colour of the image.  Alias of bg().
     *
     * @param string $colour
     *
     * @return HasBackground|GlideUrl
     * @throws InvalidColourException
     * @see HasBackground::bg()
     */
    public function background(string $colour)
    {
        return $this->bg($colour);
    }
}