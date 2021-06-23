<?php


namespace AmpedWeb\GlideUrl\Interfaces;


interface Fit
{
    /**
     * @var string Default.  Resize the image to fit within the width and height boundaries without cropping,
     * distorting or altering the aspect ratio.
     *
     * @see \AmpedWeb\GlideInABox\Can\HasSize::fit()
     */
    const CONTAIN = 'contain';

    /**
     * @var string Resizes the image to fill the width and height boundaries and crops any excess image data. The
     *      resulting image will match the width and height constraints without distorting the image. See the crop page
     *      for more information.
     *
     * @see \AmpedWeb\GlideInABox\Can\HasSize::fit()
     * @see \AmpedWeb\GlideInABox\Can\HasCrop
     */
    const CROP = 'crop';

    /**
     * @var string Resizes the image to fit within the width and height boundaries without cropping or distorting the
     *      image, and the remaining space is filled with the background color. The resulting image will match the
     *      constraining dimensions.
     *
     * @see \AmpedWeb\GlideInABox\Can\HasSize::fit()
     */
    const FILL = 'fill';

    /**
     * @var string Resizes the image to fit within the width and height boundaries without cropping, distorting or
     *      altering the aspect ratio, and will also not increase the size of the image if it is smaller than the
     *      output size.
     *
     * @see \AmpedWeb\GlideInABox\Can\HasSize::fit()
     */
    const MAX = 'max';

    /**
     * @var string Stretches the image to fit the constraining dimensions exactly. The resulting image will fill the
     *      dimensions, and will not maintain the aspect ratio of the input image.
     *
     * @see \AmpedWeb\GlideInABox\Can\HasSize::fit()
     */
    const STRETCH = 'stretch';
}