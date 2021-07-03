<?php


namespace AmpedWeb\GlideUrl\Tests\Unit;


use AmpedWeb\GlideUrl\Can\HasDimensionParser;

class MockDimensionParser
{
    use HasDimensionParser {
        dimensionIsRelative as _dimensionIsRelative;
        valueIsNumber as _valueIsNumber;
        parseDimension as _parseDimension;
    }

    public function dimensionIsRelative($dimension)
    {
        return $this->_dimensionIsRelative($dimension);
    }

    public function parseDimension($dimension)
    {
        return $this->_parseDimension($dimension);
    }

    public function valueIsNumber($value)
    {
        return $this->_valueIsNumber($value);
    }
}