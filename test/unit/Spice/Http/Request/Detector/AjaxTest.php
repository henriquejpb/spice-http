<?php
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

class AjaxTest extends AbstractDetectorTest {
    private function getDetector($method) {
        return new Ajax($method);
    }

    /**
     * @testdox Method `matches` returns true when request has `HTTP_X_REQEUESTED_WITH` server variable set to 'xmlhttprequest'
     * @test
     */
    public function testMatchesReturnsTrueWhenHttpXRequestedWithIsSetToXmlHttpRequest() {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $request->expects($this->any())
            ->method('getHeader')
            ->with($this->equalTo('X-REQUESTED-WITH'))
            ->will($this->returnValue('xmlhttprequest'));
        $this->assertTrue($detector->matches($request));
    }

    /**
     * @testdox Method `matches` returns false when request has `HTTP_X_REQEUESTED_WITH` server variable set to values other than 'xmlhttprequest'
     * @test
     */
    public function testMatchesReturnsFalseWhenHttpxRequestIsSetToAnyValueButXmlHttpRequest() {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $request->expects($this->any())
            ->method('getHeader')
            ->with($this->equalTo('X-REQUESTED-WITH'))
            ->will($this->returnValue(''));
        $this->assertFalse($detector->matches($request));
    }

    /**
     * @testdox Method `matches` returns false when request does not have `HTTP_X_REQEUESTED_WITH` server variable
     * @test
     */
    public function testMatchesReturnsFalseWhenHttpxRequestWIthIsNotSet() {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $this->assertFalse($detector->matches($request));
    }
}
