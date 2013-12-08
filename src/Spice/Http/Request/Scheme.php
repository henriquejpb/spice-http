<?php
/**
 * Defines an enumeration with the possible HTTP schemes.
 *
 * @package Spice\Http
 */
namespace Spice\Http\Request;

/**
 * Enumeration with the 2 possible HTTP schemes:
 *
 * * HTTPS
 * * HTTP
 *
 */
interface Scheme {
    const HTTP = 'http';
    const HTTPS = 'https';
}

