<?php
/**
 * A method detector will verify the HTTP request method.
 *
 * @package Spice\Http\Request\Detector;
 */
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

/**
 * Detector for HTTP request method.
 */
class Method implements DetectorInterface {
    /**
     * @var string the expected method.
     */
    private $expectedMethod;

    /**
     * Creates a method detector.
     *
     * No checking will be made to assure that `$expectedMethod` is a valid HTTP method.
     * If it is not, calling the method `matches` will always result in `false`.
     *
     * @param string $expectedMethod the expected method
     */
    public function __construct($expectedMethod) {
        $this->expectedMethod = strtolower($expectedMethod);
    }

    /**
     * Returns `true` if the request method is the expected or `false` otherwise.
     *
     * @inherit-doc
     */
    public function matches(RequestInterface $request) {
        return strtolower($request->getMethod()) == $this->expectedMethod;
    }
}
