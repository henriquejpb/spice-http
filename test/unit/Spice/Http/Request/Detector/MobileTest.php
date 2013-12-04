<?php
namespace Spice\Http\Request\Detector;

use Spice\Http\Request\RequestInterface;

class MobileTest extends AbstractDetectorTest {
    private function getDetector($method) {
        return new Mobile($method);
    }

    public function mobileProvider() {
        return array(
            array('nokia'),
            array('iphone'),
            array('android'),
            array('windows phone'),
        );
    }

    public function desktopProvider() {
        return array(
            array('mozilla'),
            array('MSIE'),
            array('chorme'),
            array('safari'),
        );
    }

    /**
     * @testdox Matches returns `true` when request header 'USER-AGENT' matches a mobile browser. 
     * @dataProvider mobileProvider
     * @test
     */
    public function testMatchesReturnsTrueWhenHttpUserAgentMatchesMobileBrowser($userAgent) {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $request->expects($this->at(0))
            ->method('getHeader')
            ->with($this->equalTo('X-WAP-PROFILE'))
            ->will($this->returnValue(false));
        $request->expects($this->at(1))
            ->method('getHeader')
            ->with($this->equalTo('PROFILE'))
            ->will($this->returnValue(false));
        $request->expects($this->at(2))
            ->method('getHeader')
            ->with($this->equalTo('USER-AGENT'))
            ->will($this->returnValue($userAgent));
        $this->assertTrue($detector->matches($request));
    }

    /**
     * @testdox Matches returns `false` when request header 'USER-AGENT' matches a desktop browser. 
     * @dataProvider desktopProvider
     * @test
     */
    public function testMatchesReturnsTrueWhenHttpUserAgentMatchesDesktopBrowser($userAgent) {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $request->expects($this->at(0))
            ->method('getHeader')
            ->with($this->equalTo('X-WAP-PROFILE'))
            ->will($this->returnValue(false));
        $request->expects($this->at(1))
            ->method('getHeader')
            ->with($this->equalTo('PROFILE'))
            ->will($this->returnValue(false));
        $request->expects($this->at(2))
            ->method('getHeader')
            ->with($this->equalTo('USER-AGENT'))
            ->will($this->returnValue($userAgent));
        $this->assertFalse($detector->matches($request));
    }


    /**
     * @testdox Matches returns `true` when request header 'X-WAP-PROFILE' is set.
     * @test
     */
    public function testMatchesReturnsTrueWhenHttpXWapProfileIsSet() {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $request->expects($this->once())
            ->method('getHeader')
            ->with($this->equalTo('X-WAP-PROFILE'))
            ->will($this->returnValue(true));
        $this->assertTrue($detector->matches($request));
    }

    /**
     * @testdox Matches returns `true` when request header 'PROFILE' is set.
     * @test
     */
    public function testMatchesReturnsTrueWhenHttpProfileIsSet() {
        $detector = $this->getDetector('post');
        $request = $this->getRequestMock('post');
        $request->expects($this->at(0))
            ->method('getHeader')
            ->with($this->equalTo('X-WAP-PROFILE'))
            ->will($this->returnValue(false));
        $request->expects($this->at(1))
            ->method('getHeader')
            ->with($this->equalTo('PROFILE'))
            ->will($this->returnValue(true));
        $this->assertTrue($detector->matches($request));
    }
}

