<?php


namespace AmpedWeb\GlideUrl\Can;

use AmpedWeb\GlideUrl\Exceptions\InvalidFlipException;
use AmpedWeb\GlideUrl\Interfaces\Flip;

/**
 * Trait Flip
 *
 * @property array $buildParams
 *
 * @see https://glide.thephpleague.com/1.0/api/flip/
 * @package AmpedWeb\GlideUrl\Can
 */
trait HasFlip
{
    /**
     * Flip the image
     *
     * If $flip is `null`, the flip parameter is removed
     *
     * @param string|null $flip One of:
     *                     - 'both',
     *                     - 'h',
     *                     - 'v'.
     *                     - null
     *                     Or you can use the interface constants:
     *                     - Flip::BOTH
     *                     - FLip::HORIZONTAL
     *                     - Flip::VERTICAL
     *
     * @return $this
     * @throws InvalidFlipException
     */
    public function flip(string $flip = null)
    {
        if ($flip !== Flip::BOTH &&
            $flip !== Flip::HORIZONTAL &&
            $flip !== Flip::VERTICAL &&
            $flip !== null
        ) {
            throw new InvalidFlipException();
        }

        $this->buildParams['flip'] = $flip;

        if ($flip === null) {
            unset($this->buildParams['flip']);
        }

        return $this;
    }
}