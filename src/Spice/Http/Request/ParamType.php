<?php
/**
 * Defines an enumeration with the possible request param types.
 *
 * @package Spice\Http\Request
 */
namespace Spice\Http\Request;

/**
 * Enumeration with the 5 possible types of request params:
 *
 * * POST
 * * QUERY
 * * FILE
 * * ROUTE
 * * SERVER
 */
interface ParamType {
    const POST   = '_POST';
    const QUERY  = '_QUERY';
    const FILE   = '_FILE';
    const ROUTE  = '_ROUTE';
    const SERVER = '_SERVER';
}
