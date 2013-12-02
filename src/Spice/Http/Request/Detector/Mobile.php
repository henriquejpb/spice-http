<?php
/**
 * A method detector will verify the HTTP request was originated in a mobile device.
 *
 * @package Spice\Http\Request\Detector;
 */
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

/**
 * Detector for mobile requests.
 */
class Mobile implements DetectorInterface {
    /**
     * Returns `true` if the request is originated in a mobile device or `false` otherwise.
     *
     * @inherit-doc
     */
    public function matches(RequestInterface $request) {
	    static $regex_match = '#(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220)#i';

	    return $request->getServer('HTTP_X_WAP_PROFILE', false) !== false or $request->getServer('HTTP_PROFILE', false) !== false or preg_match($regex_match, strtolower($request->getServer('HTTP_USER_AGENT')));
    }
}
