<?php
/**
 * Defines the interface for HTTP Response objects.
 *
 * @package Spice\Http\Response
 */
namespace Spice\Http\Response;

use Spice\Http\MessageInterface;

/**
 * Defines behaviour for HTTP Response objects.
 */
interface ResponseInterface extends MessageInterface {
    /**
     * Gets the response status code.
     *
     * @return int the response status code.
     */
    public function getStatusCode();

    /**
     * Gets the response reason phrase (the phare for the status code).
     *
     * @return string
     */
    public function getReasonPhrase();
}
