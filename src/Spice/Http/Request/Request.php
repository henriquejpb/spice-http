<?php
/**
 * Default implementation for HTTP Request objects.
 *
 * @package Spice\Http\Request
 */
namespace Spice\Http\Request;

use Spice\Http\AbstractMessage;
use Spice\Http\Version;
use Spice\Http\Request\Detector\DetectorInterface;

/**
 * Represents an HTTP Request.
 */
class Request extends AbstractMessage implements RequestInterface {
    /**
     * @var string the URI of the request
     */
    private $uri;

    /**
     * @var string the method of the request
     */
    private $method;

    /**
     * @var array<string, DetectorInterface> holds the detectors for the request
     */
    private $detectors = array();

    /**
     * Creates a Request object.
     *
     * @param string $uri the URI of the request
     * @param string $httpMethod [OPTIONAL] the HTTP method of the request. The default value is 'GET'
     * @param string $httpVersion [OPTIONAL] the HTTP version of the request. The default value is 'HTTP/1.1'
     */
    public function __construct($uri, $httpMethod = Method::GET, $httpVersion = Version::HTTP_1_1) {
        $refMethod = new \ReflectionClass('Spice\Http\Request\Method');
        $constants = $refMethod->getConstants();
        if (!in_array(strtoupper($httpMethod), $constants)) {
            throw new \DomainException("Invalid HTTP method '{$httpMethod}'");
        }
        
        $this->uri = $uri;
        $this->method = $httpMethod;
        parent::__construct($httpVersion);
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\Request\RequestInterface::getUri()
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\Request\RequestInterface::getMethod()
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\Request\RequestInterface::addDetector()
     */
    public function addDetector($name, DetectorInterface $detector) {
        $this->detectors[$name] = $detector;
        return $this;
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\Request\RequestInterface::removeDetector()
     */
    public function removeDetector($name) {
        if (array_key_exists($name, $this->detectors)) {
            unset($this->detectors[$name]);
        }
        return $this;
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\Request\RequestInterface::is()
     */
    public function is($detector) {
        if (!array_key_exists($detector, $this->detectors)) {
            throw new \InvalidArgumentException("Request object does not have a detector names '$detector'");
        }
        return $this->detectors[$detector]->matches($this);
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\MessageInterface::assemble()
     */
    public function assemble() {
        $reqText = $this->method . ' ' . $this->uri . ' ' . $this->getVersion() . "\r\n";
        $reqText .= $this->assembleHeaders(); 
        $reqText .= "\r\n";
        $reqText .= $this->getBody();
        return $reqText;
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\MessageInterface::__toString()
     */
    public function __toString() {
        return $this->assemble();
    }
}
