<?php
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

class MethodTest extends \PHPUnit_Framework_TestCase {
    private function getDetector($method) {
        return new Method($method);
    }

    private function getRequestMock($method) {
        $request = $this->getMockForAbstractClass('\\Spice\\Http\\Request\\RequestInterface');
        $request->expects($this->any())
            ->method('getMethod')
            ->will($this->returnValue($method));
        return $request;
    } 

    /**
     * @testdox Method `matches` returns true when request method is the same as expected.
     * @test
     */
    public function testMatchesReturnsTrueWhenMethodIsExpected() {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $this->assertTrue($detector->matches($request));
    }

    /**
     * @testdox Method `matches` returns false when request method is not the same as expected.
     * @test
     */
    public function testMatchesReturnsFalseWhenMethodIsNotExpected() {
        $detector = $this->getDetector('get');
        $request = $this->getRequestMock('post');
        $this->assertFalse($detector->matches($request));
    }
}
