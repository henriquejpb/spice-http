<?php
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

class FlashTest extends AbstractDetectorTest {
    private function getDetector($method) {
        return new Flash($method);
    }

    /**
     * @testdox Method `matches` returns true when request `HTTP_USER_AGENT` param contains 'shockwave|flash'
     * @test
     */
    public function testMatchesReturnsTrueWhenHttpUserAgentContainsKeywords() {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $request->expects($this->any())
            ->method('getHeader')
            ->with($this->equalTo('USER-AGENT'))
            ->will($this->returnValue('shockwave flash'));
        $this->assertTrue($detector->matches($request));
    }

    /**
     * @testdox Method `matches` returns true when request `HTTP_USER_AGENT` param does not contain 'shockwave|flash'
     * @test
     */
    public function testMatchesReturnsFalseWhenHttpUserAgentDoesNotContainKeywords() {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $request = $this->getRequestMock('post');
        $request->expects($this->any())
            ->method('getHeader')
            ->with($this->equalTo('USER-AGENT'))
            ->will($this->returnValue('mozilla'));
        $this->assertFalse($detector->matches($request));
    }

}
