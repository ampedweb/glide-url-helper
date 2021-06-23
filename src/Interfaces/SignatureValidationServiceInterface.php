<?php


namespace AmpedWeb\GlideUrl\Interfaces;

use Closure;

interface SignatureValidationServiceInterface
{
    public function validate($path, Closure $callback = null);
}
