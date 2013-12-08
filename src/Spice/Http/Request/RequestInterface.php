<?php
/**
 * Defines the interface for HTTP Request objects.
 *
 * @package Spice\Http\Request
 */
namespace Spice\Http\Request;

use Spice\Http\MessageInterface;
use Spice\Http\Request\Detector\DetectorInterface;

/**
 * Defines behaviour for HTTP Request objects.
 */
interface RequestInterface extends MessageInterface {
    /**
     * Returns the request URI.
     *
     * @return string
     */
    public function getUri();

    /**
     * Returns the request method.
     *
     * @return string
     */
    public function getMethod();

    /**
     * Adds a detector to the request.
     *
     * A detector is an object that can check params from the request
     * and see if it fits some special condition (ex.: if it is a POST, GET, etc. request,
     * if it was made with a XmlHttpRequest object of if it comes from a flash application)
     *
     * @param string $name the name of the detector
     * @param Spice\Http\Request\Detector\DetectorInterface
     *
     * @return RequestInterface fluent interface
     */
    public function addDetector($name, DetectorInterface $detector); 

    /**
     * Removes a detector from the request.
     *
     * @param string $name the name of the detector
     */
    public function removeDetector($name);

    /**
     * Checks if the request matches a detector condition.
     *
     * @param string $detectorName
     *
     * @return boolean
     *
     * @throws \InvalidArgumentException if there is no detector identified by `$detectorName`
     */
    public function is($detectorName);
}
