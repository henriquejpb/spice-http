<?php
/**
 * Defines an enumeration with the possible HTTP versions.
 *
 * @package Spice\Http
 */
namespace Spice\Http;

/**
 * Enumeration with the 2 possible HTTP versions:
 *
 * * HTTP/1.1
 * * HTTP/1.0
 *
 */
interface Version {
    const HTTP_1_1 = 'HTTP/1.1';
    const HTTP_1_0 = 'HTTP/1.0';
}

