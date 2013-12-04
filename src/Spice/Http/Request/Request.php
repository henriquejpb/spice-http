<?php
namespace Spice\Http\Request;

use Spice\Http\AbstractMessage;
use Spice\Http\Version;
use Spice\Http\Request\Detector\DetectorInterface;

class Request extends AbstractMessage implements RequestInterface {
    private $uri;

    private $method;

    private $detectors = array();

    public function __construct($uri, $httpMethod = Method::GET, $httpVersion = Version::HTTP_1_1) {
        $refMethod = new \ReflectionClass('Spice\Http\Request\Method');
        $constants = $refMethod->getConstants();
        if (!in_array(strtoupper($httpMethod), $constants)) {
            throw new \DomainException("Invalid HTTP method '{$httpMethod}'");
        }
        
        $refVersion = new \ReflectionClass('Spice\Http\Version');
        $constants = $refVersion->getConstants();
        if (!in_array(strtoupper($httpVersion), $constants)) {
            throw new \DomainException("Invalid HTTP version '{$httpVersion}'");
        }
        
        $this->uri = $uri;
        $this->method = $httpMethod;
        parent::__construct($httpVersion);
    }

    public function getUri() {
        return $this->uri;
    }

    public function getMethod() {
        return $this->method;
    }

    public function addDetector($name, DetectorInterface $detector) {
        $this->detectors[$name] = $detector;
        return $this;
    }

    public function removeDetector($name) {
        if (array_key_exists($name, $this->detectors)) {
            unset($this->detectors[$name]);
        }
        return $this;
    }

    public function is($detector) {
        if (!array_key_exists($detector, $this->detectors)) {
            throw new \InvalidArgumentException("Request object does not have a detector names '$detector'");
        }
        return $this->detectors[$detector]->matches($this);
    }

    public function assemble() {
        $reqText = $this->method . ' ' . $this->uri . ' ' . $this->getVersion() . "\r\n";
        $reqText .= $this->assembleHeaders(); 
        $reqText .= "\r\n";
        $reqText .= $this->getBody();
        return $reqText;
    }

    public function __toString() {
        return $this->assemble();
    }
}
