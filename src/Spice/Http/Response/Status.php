<?php
/**
 * Enumeration containing all existing HTTP response status codes and its descritpions.
 *
 * @package Spice\Http\Response
 */
namespace Spice\Http\Response;

/**
 * Enum for HTTP response statuses.
 */
interface Status {
    /* 1xx - Informational */
    const _CONTINUE                     = '100 Continue';
    const SWITCHING_PROTOCOLS           = '101 Switching Protocols';

    /* 2xx - Success */
    const OK                            = '200 Ok';
    const CREATED                       = '201 Created';
    const ACCEPTED                      = '202 Accepted';
    const NON_AUTHORITATIVE_INFORMATION = '203 Non-Authoritative Information';
    const NO_CONTENT                    = '204 No Content';
    const RESET_CONTENT                 = '205 Reset Content';
    const PARTIAL_CONTENT               = '206 Partial Content';

    /* 3xx - Redirection */
    const MULTIPLE_CHOICES              = '300 Multiple Choices';
    const MOVED_PERMANENTLY             = '301 Moved Permanently';
    const FOUND                         = '302 Found';
    const SEE_OTHER                     = '303 See Other';
    const NOT_MODIFIED                  = '304 Not Modified';
    const USE_PROXY                     = '305 Use Proxy';
    const TEMPORARILY_REDIRECT          = '307 Temporarily Redirect';

    /* 4xx - Client Error */
    const BAD_REQUEST                   = '400 Bad Request';
    const UNAUTHORIZED                  = '401 Unauthorized';
    const PAYMENT_REQUIRED              = '402 Payment Required';
    const FORBIDDEN                     = '403 Forbidden';
    const NOT_FOUND                     = '404 Not Found';
    const METHOD_NOT_ALLOWED            = '405 Method Not Allowed';
    const NOT_ACCEPTABLE                = '406 Not Acceptable';
    const PROXY_AUTHENTICATION_REQUIRED = '407 Proxy Authentication Required';
    const REQUEST_TIMEOUT               = '408 Request Timeout';
    const CONFILICT                     = '409 Conflict';
    const GONE                          = '410 Gone';
    const LENGTH_REQUIRED               = '411 Length Required';
    const PRECONDITION_FAILED           = '412 Precondition Failed';
    const REQUEST_ENTITY_TOO_LARGE      = '413 Request Entity Too Large';
    const REQUEST_URI_TOO_LARGE         = '414 Request URI Too Large';
    const UNSUPPORTED_MEDIA_TYPE        = '415 Unsupported Media Type';
    const REQUEST_RANGE_NOT_SATISFIED   = '416 Request Range Not Satisfied';
    const EXPECTATION_FAILED            = '417 Expectation Failed';

    /* 5xx - Server Error */
    const INTERNAL_SERVER_ERROR         = '500 Internal Server Error';
    const NOT_IMPLEMENTED               = '501 Not Implemented';
    const BAD_GATEWAY                   = '502 Bad Gateway';
    const SERVICE_UNAVAILABLE           = '503 Service Unavailable';
    const GATEWAY_TIMEOUT               = '504 Gateway Timeout';
    const HTTP_VERSION_NOT_SUPPORTED    = '505 HTTP Version Not Supported';
}
