<?php
/**
 * Defines an enumeration with the possible HTTP request methods.
 *
 * @package Spice\Http
 */
namespace Spice\Http;

/**
 * Enumeration with the 8 possible HTTP versions:
 *
 * * OPTIONS
 * * GET
 * * HEAD
 * * POST
 * * PUT
 * * DELETE
 * * TRACE
 * * CONNECT
 *
 */
interface Method {
    const OPTIONS = 'OPTIONS';
    const GET     = 'GET';
    const HEAD    = 'HEAD';
    const POST    = 'POST';
    const PUT     = 'PUT';
    const DELETE  = 'DELETE';
    const TRACE   = 'TRACE';
    const CONNECT = 'CONNECT';
}

