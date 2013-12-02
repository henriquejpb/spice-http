<?php
/**
 * A detector is an object that can check params from the request
 * and see if it fits some special condition (ex.: if it is a POST, GET, etc. request,
 * if it was made with a XmlHttpRequest object of if it comes from a flash application)
 *
 * @package Spice\Http\Request\Detector
 */
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

/**
 * Defines common behaviour for Detector objects.
 */
interface DetectorInterface {
    /**
     * Checks if a given request object matches some condition.
     *
     * @param Spice\Http\Request\RequestInterface $request the request to be matched
     */
    public function matches(RequestInterface $request);
}
