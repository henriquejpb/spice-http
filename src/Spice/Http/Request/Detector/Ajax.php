<?php
/**
 * A method detector will verify the HTTP request was made via a XmlHttpRequest object.
 *
 * @package Spice\Http\Request\Detector;
 */
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

/**
 * Detector for HTTP request method.
 */
class Ajax implements DetectorInterface {
    /**
     * Returns `true` if the request method is the expected or `false` otherwise.
     *
     * @inherit-doc
     */
    public function matches(RequestInterface $request) {
        return strtolower($request->getServer('HTTP_X_REQUESTED_WITH', false)) === 'xmlhttprequest';
    }
}
