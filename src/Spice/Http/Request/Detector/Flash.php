<?php
/**
 * A method detector will verify the HTTP request was originated in a flash object.
 *
 * @package Spice\Http\Request\Detector;
 */
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

/**
 * Detector for flash requests.
 */
class Flash implements DetectorInterface {
    /**
     * Returns `true` if the request is originated in a flash object or `false` otherwise.
     *
     * @inherit-doc
     */
    public function matches(RequestInterface $request) {
        return (bool) preg_match('/shockwave ?flash/i', $request->getHeader('USER-AGENT', false));
    }
}
