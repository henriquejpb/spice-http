<?php
/**
 * A method detector will verify the HTTP request was made via a XmlHttpRequest object.
 *
 * @package Spice\Http\Request\Detector;
 */
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

/**
 * Detector for ajax requests.
 */
class Ajax implements DetectorInterface {
    /**
     * Returns `true` if the request was made via a XmlHttpRequest object or `false` otherwise.
     *
     * @inherit-doc
     */
    public function matches(RequestInterface $request) {
        return strtolower($request->getHeader('X-REQUESTED-WITH', false)) === 'xmlhttprequest';
    }
}
