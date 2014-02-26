<?php
/**
 * AbstractMessage implements common funcionalities for both request and response,
 * such as managing its headers and its body.
 *
 * No check for the validity of the header will be done, because this would be an
 * unecessary overhead. AbstractMessage implementation assumes that the programmer
 * knows the basic of the HTTP protocol and its messages.
 *
 * @package Spice\Http
 */
namespace Spice\Http;

/**
 * Wraps the default implementation for headers and body management in a generic way, 
 * so it can be extended by both requests and response implementations.
 */
abstract class AbstractMessage implements MessageInterface {
    /**
     * @var array<string, string> holds the message headers.
     */
    private $headers = array();

    /**
     * @var string holds the message body.
     */
    private $body;

    /**
     * @var string the HTTP protocol version.
     */
    private $version;

    /**
     * Initializes a message.
     *
     * @param string $version one of the `Spice\Http\Version` constants.
     */
    public function __construct($version = Version::HTTP_1_1) {
        $this->setVersion($version);
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::getVersion()
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     * @{inherit-doc}
     * 
     * @see \Spice\Http\MessageInterface::setVersion()
     */
    public function setVersion($version) {
        if (!in_array($version, array(
            Version::HTTP_1_1,
            Version::HTTP_1_0
        ))) {
            throw new \InvalidArgumentException("Invalid HTTP version '{$version}'");
        }
        $this->version = $version;
    }

    /**
     * @{inherit-doc}
     *
     * @param string $name the name of the header.
     *      (there will be no check for the validity of the name)
     * @param string $value the value of the header. 
     *      It should be a string or an object that can be casted to a string.
     *
     * @see \Spice\Http\MessageInterface::setHeader()
     */
    public function setHeader($name, $value) {
        $this->headers[$this->normalizeHeaderName($name)] = (string) $value;
        return $this;
    }

    /**
     * @{inherit-doc}
     *
     * @see Spice\Http\MessageInterface::setHeaders()
     */
    public function setHeaders(array &$headers) {
        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }
        return $this;
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::getHeader()
     */
    public function getHeader($name, $default = null) {
        $name = $this->normalizeHeaderName($name);
        return array_key_exists($name, $this->headers)
             ? $this->headers[$name]
             : $default;
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::getHeader()
     */
    public function getAllHeaders() {
        return $this->headers; 
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::getHeader()
     */
    public function unsetHeader($name) {
        $name = $this->normalizeHeaderName($name);
        if (array_key_exists($name, $this->headers)) {
            unset($this->headers[$name]);
        }
        return $this;
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::clearHeaders()
     */
    public function clearHeaders() {
        $this->headers = array();
        return $this;
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::setBody()
     */
    public function setBody($content) {
        $this->body = (string) $content;
        return $this;
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::getBody()
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::appendBody()
     */
    public function appendBody($content) {
        $this->body .= $content;
        return $this;
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::prependBody()
     */
    public function prependBody($content) {
        $this->body = $content . $this->body;
        return $this;
    }

    /**
     * @{inherit-doc}
     *
     * @see \Spice\Http\MessageInterface::prependBody()
     */
    public function clearBody() {
        $this->body = '';
        return $this;
    }

    /**
     * Normalizes a header name to fit the pattern:
     *
     *   `'Header-Name'`
     *
     * Thai is, upper camel-case hyphen-separated.
     *
     * @param string $name the name of the header
     *
     * @return string
     */
    private function normalizeHeaderName($name) {
        $name = str_replace('-', ' ', $name);
        $name = str_replace('_', ' ', $name);
        $name = ucwords(strtolower($name));
        return str_replace(' ', '-', $name);
    }

    /**
     * Assembles the request headers.
     *
     * @return string
     */
    protected function assembleHeaders() {
        $output = '';
        foreach ($this->headers as $name => &$value) {
            $output .= "{$name}: {$value}\r\n"; 
        }
        return $output;
    }
}
