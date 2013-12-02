<?php
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

abstract class AbstractDetectorTest extends \PHPUnit_Framework_TestCase {
    protected function getRequestMock($method) {
        $request = $this->getMockForAbstractClass('\\Spice\\Http\\Request\\RequestInterface');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue($method));
        return $request;
    } 
}
