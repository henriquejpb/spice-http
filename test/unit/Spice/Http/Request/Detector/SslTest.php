<?php
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

class SslTest extends AbstractDetectorTest {
    private function getDetector() {
        return new Ssl();
    }

    /**
     * @testdox Method `matches` returns true when request `HTTPS` or `HTTP_HTTPS` server variable is set
     * @test
     */
    public function testMatchesReturnsTrueWhenHttpsIsSet() {
        $detector = $this->getDetector();
        $request = $this->getRequestMock('post');
        $request->expects($this->at(0))
            ->method('getServer')
            ->with($this->equalTo('HTTPS'))
            ->will($this->returnValue(''));
        $request->expects($this->at(1))
            ->method('getServer')
            ->with($this->equalTo('HTTP_HTTPS'))
            ->will($this->returnValue('on'));
        $this->assertTrue($detector->matches($request));

        $request = $this->getRequestMock('post');
        $request->expects($this->once())
            ->method('getServer')
            ->with($this->equalTo('HTTPS'))
            ->will($this->returnValue('on'));
        $this->assertTrue($detector->matches($request));
    }

    /**
     * @testdox Method `matches` returns false when request `HTTPS` server variable  is not set
     * @test
     */
    public function testMatchesReturnsFalseWhenHttpsIsNotSet() {
        $detector = $this->getDetector();
        $request = $this->getRequestMock('post');
        $request->expects($this->at(0))
            ->method('getServer')
            ->with($this->equalTo('HTTPS'))
            ->will($this->returnValue(''));
        $request->expects($this->at(1))
            ->method('getServer')
            ->with($this->equalTo('HTTP_HTTPS'))
            ->will($this->returnValue(''));
        $this->assertFalse($detector->matches($request));
    }

}

