<?php
/**
 * Defines MessageInterface for HTTP Messages.
 *
 * HTTP messages can be of two types: Requests and Responses.
 * Although their structures are different, there are many common 
 * behaviours, such as defining headers and a body.
 *
 * @package Spice\Http
 */
namespace Spice\Http;

/**
 * Defines common behaviour for HTTP Messages.
 */
interface MessageInterface {
    /**
     * Sets a HTTP header.
     *
     * @param string $name The header name.
     * @param mixed $value The header value.
     *
     * @return Spice\Http\MessageInterface Fluent interface
     */
    public function setHeader($name, $value);

    /**
     * Sets HTTP headers form key-value pairs.
     *
     * @param param $headers A key-value pair array, where the key is the
     *      header name and the value is the header value
     *
     * @return Spice\Http\MessageInterface Fluent interface
     */
    public function setHeaders(array &$headers);

    /**
     * Unsets a HTTP header.
     *
     * @param string $name The header name.
     *
     * @return Spice\Http\MessageInterface Fluent interface
     */
    public function unsetHeader($name);

    /**
     * Removes all HTTP headers.
     *
     * @return Spice\Http\MessageInterface Fluent interface
     */
    public function clearHeaders();

    /**
     * Gets a HTTP header.
     *
     * @param string $name The header name.
     * @param mixed $default A default value to return if such header does not exist.
     *
     * @return mixed
     */
    public function getHeader($name, $default = null);

    /**
     * Gets all set HTTP headers.
     *
     * @param string $name The header name
     *
     * @return array
     */
    public function getAllHeaders();

    /**
     * Prepends content to the response body.
     *
     * @param mixed $content The content to append.
     * @param string $name A name for this part of the content.
     *
     * @return Spice\Http\MessageInterface Fluent interface
     */
    public function appendBody($content);

    /**
     * Appends content to the response body.
     *
     * @param string $content The content to preppend.
     * @param string $name A name for this part of the content.
     *
     * @return Spice\Http\MessageInterface Fluent interface
     */
    public function prependBody($content);

    /**
     * Sets the content of the response body.
     *
     * @param mixed $content The content.
     *
     * @return Spice\Http\MessageInterface Fluent interface
     */
    public function setBody($content);

    /**
     * Returns the content of the body.
     *
     * @return string
     */
    public function getBody();

    /**
     * Clears the response body content.
     * 
     * @return Spice\Http\MessageInterface Fluent interface.
     */
    public function clearBody();

    /**
     * Assembles the message creating a well-formed HTTP message.
     * 
     * @return string the assembled message
     */
    public function assemble();
    
    /**
     * Convets the HTTP message to a string, by assembling it.
     * 
     * @return string the assembled message
     */
    public function __toString();
}
