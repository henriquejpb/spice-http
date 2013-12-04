<?php
/**
 * A method detector will verify the HTTP request was made thought a SSL tunnel.
 *
 * @package Spice\Http\Request\Detector;
 */
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

/**
 * Detector for SSL requests.
 */
class Ssl implements DetectorInterface {
    /**
     * Returns `true` if the request was made via SSL or `false` otherwise.
     *
     * @inherit-doc
     */
    public function matches(RequestInterface $request) {
        /* return strtolower($request->getServer('HTTPS', false)) === 'on' */
            /* || strtolower($request->getServer('HTTP_HTTPS', false)) === 'on'; */
    }
}
