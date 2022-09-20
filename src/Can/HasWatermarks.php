<?php


namespace AmpedWeb\GlideUrl\Can;

use AmpedWeb\GlideUrl\Exceptions\InvalidDimensionException;
use AmpedWeb\GlideUrl\Exceptions\InvalidFitException;
use AmpedWeb\GlideUrl\Exceptions\InvalidMarkFitException;
use AmpedWeb\GlideUrl\Exceptions\InvalidMarkPositionException;
use AmpedWeb\GlideUrl\Interfaces\Fit;
use AmpedWeb\GlideUrl\Interfaces\Position;

/**
 * This trait provides watermarks functionality
 *
 * @package AmpedWeb\GlideUrl\Can
 * @link    https://glide.thephpleague.com/1.0/api/watermarks/
 */
trait HasWatermarks
{
    use HasDimensionParser;

    /**
     * @property array $buildParams
     */

    /** @var string  */
    public static $MARKPOS_TOP_LEFT = 'top-left';

    /** @var string  */
    public static $MARKPOS_TOP = 'top';

    /** @var string  */
    public static $MARKPOS_TOP_RIGHT = 'top-right';

    /** @var string  */
    public static $MARKPOS_LEFT = 'left';

    /** @var string  */
    public static $MARKPOS_CENTER = 'center';

    /** @var string  */
    public static $MARKPOS_RIGHT = 'right';

    /** @var string  */
    public static $MARKPOS_BOTTOM_LEFT = 'bottom-left';

    /** @var string  */
    public static $MARKPOS_BOTTOM = 'bottom';

    /** @var string  */
    public static $MARKPOS_BOTTOM_RIGHT = 'bottom-right';

    /**
     * Adds a watermark to the image.
     *
     * Must be a path to an image in the watermarks file system, as configured in your server.
     *
     * If $filename is null, the watermark parameter is removed
     *
     * @param string|null $filename
     *
     * @return HasWatermarks
     */
    public function mark(string $filename = null)
    {
        $this->buildParams['mark'] = $filename;

        if ($filename === null) {
            unset($this->buildParams['mark']);
        }

        return $this;
    }

    /**
     * Sets the width of the watermark in pixels, or using relative dimensions.
     *
     * If $dimension is null, the watermark width parameter is removed
     *
     * @param string|null $dimension
     *
     * @return HasWatermarks
     * @throws InvalidDimensionException
     */
    public function markWidth(string $dimension = null)
    {
        if ($dimension === null) {
            unset($this->buildParams['markw']);
            return $this;
        }

        $this->buildParams['markw'] = $this->parseDimension($dimension);

        return $this;
    }

    /**
     * Sets the height of the watermark in pixels, or using relative dimensions.
     *
     * If $dimension is null, the height parameter is removed
     *
     * @param string|null $dimension
     *
     * @return HasWatermarks
     * @throws InvalidDimensionException
     */
    public function markHeight(string $dimension = null)
    {
        if ($dimension === null) {
            unset($this->buildParams['markh']);
            return $this;
        }

        $this->buildParams['markh'] = $this->parseDimension($dimension);

        return $this;
    }

    /**
     * Sets how the watermark is fitted to its target dimensions.
     *
     * Accepts:
     *
     * - `contain`: Default. Resizes the image to fit within the width and height boundaries without cropping,
     * distorting or altering the aspect ratio.
     * - `max`: Resizes the image to fit within the width and height boundaries without cropping, distorting or
     * altering the aspect ratio, and will also not increase the size of the image if it is smaller than the output
     * size.
     * - `fill`: Resizes the image to fit within the width and height boundaries without cropping or distorting the
     * image, and the remaining space is filled with the background color. The resulting image will match the
     * constraining dimensions.
     * - `stretch`: Stretches the image to fit the constraining dimensions exactly. The resulting image will fill the
     * dimensions, and will not maintain the aspect ratio of the input image.
     * - `crop`: Resizes the image to fill the width and height boundaries and crops any excess image data. The
     * resulting image will match the width and height constraints without distorting the image. See the crop page for
     * more information.
     *
     * @param string $fit Accepts the following values:
     *                    - `contain`: Default. Resizes the image to fit within the width and height boundaries without
     *                    cropping, distorting or altering the aspect ratio.
     *                    - `max`: Resizes the image to fit within the width and height boundaries without cropping,
     *                    distorting or altering the aspect ratio, and will also not increase the size of the image if
     *                    it is smaller than the output size.
     *                    - `fill`: Resizes the image to fit within the width and height boundaries without cropping or
     *                    distorting the image, and the remaining space is filled with the background color. The
     *                    resulting image will match the constraining dimensions.
     *                    - `stretch`: Stretches the image to fit the constraining dimensions exactly. The resulting
     *                    image will fill the dimensions, and will not maintain the aspect ratio of the input image.
     *                    - `crop`: Resizes the image to fill the width and height boundaries and crops any excess
     *                    image data. The resulting image will match the width and height constraints without
     *                    distorting the image. See the crop page for more information.
     *
     * @return HasWatermarks
     * @throws InvalidMarkFitException
     */
    public function markFit(string $fit = 'contain')
    {
        if ($fit !== Fit::CONTAIN &&
            $fit !== Fit::CROP &&
            $fit !== Fit::FILL &&
            $fit !== Fit::MAX &&
            $fit !== Fit::FILL_MAX &&
            $fit !== Fit::STRETCH
        ) {
            throw new InvalidFitException();
        }

        $this->buildParams['markfit'] = $fit;

        return $this;
    }

    /**
     * Sets how far the watermark is away from the left and right edges of the image.
     *
     * Set in pixels, or using relative dimensions. Ignored if `markpos` is set to center.
     *
     * If $dimension is null, the parameter is removed
     *
     * @param string|null $dimension
     *
     * @return HasWatermarks
     * @throws InvalidDimensionException
     */
    public function markX(string $dimension = null)
    {
        if ($dimension === null) {
            unset ($this->buildParams['markx']);
            return $this;
        }

        $this->buildParams['markx'] = $this->parseDimension($dimension);

        return $this;
    }

    /**
     * Sets how far the watermark is away from the top and bottom edges of the image.
     *
     * Set in pixels, or using relative dimensions. Ignored if `markpos` is set to center.
     *
     * If $dimension is null, the parameter is removed.
     *
     * @param string|null $dimension
     *
     * @return HasWatermarks
     * @throws InvalidDimensionException
     */
    public function markY(string $dimension = null)
    {
        if ($dimension === null) {
            unset($this->buildParams['marky']);
            return $this;
        }

        $this->buildParams['marky'] = $this->parseDimension($dimension);

        return $this;
    }

    /**
     * Sets how far the watermark is away from edges of the image.
     *
     * Basically a shortcut for using both `markx` and `marky`. Set in pixels, or using relative dimensions. Ignored if
     * `markpos` is set to center.
     *
     * If $dimension is null, the parameter is removed.
     *
     * @param string|null $dimension
     *
     * @return HasWatermarks
     * @throws InvalidDimensionException
     */
    public function markPad(string $dimension = null)
    {
        if ($dimension === null) {
            unset ($this->buildParams['markpad']);
            return $this;
        }

        $this->buildParams['markpad'] = $this->parseDimension($dimension);

        return $this;
    }

    /**
     * Sets where the watermark is positioned.
     *
     * Accepts `top-left`, `top`, `top-right`, `left`, `center`, `right`, `bottom-left`, `bottom`, `bottom-right`.
     * Default is `center`.
     *
     * @param string $position Accepts :
     *                         - `top-left`
     *                         - `top`,
     *                         - `top-right`,
     *                         - `left`,
     *                         - `center`,
     *                         - `right`,
     *                         - `bottom-left`,
     *                         - `bottom`,
     *                         - `bottom-right`.
     *
     * @return HasWatermarks
     */
    public function markPos(string $position = 'center')
    {
        if ($position !== Position::TOP_LEFT &&
            $position !== Position::TOP &&
            $position !== Position::TOP_RIGHT &&
            $position !== Position::LEFT &&
            $position !== Position::CENTER &&
            $position !== Position::RIGHT &&
            $position !== Position::BOTTOM_LEFT &&
            $position !== Position::BOTTOM &&
            $position !== Position::BOTTOM_RIGHT
        ) {
            throw new InvalidMarkPositionException();
        }

        $this->buildParams['markpos'] = $position;

        return $this;
    }

    /**
     * Sets the opacity of the watermark.
     *
     * Use values between `0` and `100`, where `100` is fully opaque, and `0` is fully transparent. The default value
     * is `100`.
     *
     * @param int $alpha
     */
    public function markAlpha(int $alpha = 100)
    {
        $alpha = max(0, $alpha);
        $alpha = min($alpha, 100);

        $this->buildParams['markalpha'] = $alpha;

        return $this;
    }
}