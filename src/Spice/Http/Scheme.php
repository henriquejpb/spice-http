<?php
/**
 * Defines an enumeration with the possible HTTP schemes.
 *
 * @package Spice\Http
 */
namespace Spice\Http;

/**
 * Enumeration with the 2 possible HTTP schemes:
 *
 * * HTTPS
 * * HTTP
 *
 */
interface SCHEME {
    const HTTP = 'http';
    const HTTPS = 'https';
}

