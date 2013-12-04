<?php
namespace Spice\Http\Request;

use Spice\Testing\BaseTestCase;
use Spice\Http\Version;
use Spice\Http\Request\Method;

class RequestTest extends BaseTestCase {
    public function getRequest($uri, $method = Method::GET, $version = Version::HTTP_1_1) {
        return new Request($uri, $method, $version);
    }

    /**
     * @testdox Properly gets the request URI.
     * @test
     */
    public function testGetUri() {
        $request = $this->getRequest('/test.php');
        $this->assertEquals('/test.php', $request->getUri());
    }

    /**
     * @testdox Request method is default set to 'GET', port is set to 80, sheme is set to 'HTTP' and version is set to 'HTTP/1.1'
     * @test
     */
    public function testCreationWithDefaults() {
        $request = new Request('/test.php');
        $this->assertEquals(Method::GET, $request->getMethod());
        $this->assertEquals(Version::HTTP_1_1, $request->getVersion());
    }

    /**
     * @testdox Non-default valid request method is properly set.
     * @test
     */
    public function testCreationWithNonDefaultValidMethod() {
        $request = new Request('/test.php', Method::POST);
        $this->assertEquals(Method::POST, $request->getMethod());
    }

    /**
     * @testdox Invalid request method throws exception.
     * @test
     * @expectedException \DomainException
     */
    public function testCreationWithNonDefaultNonValidMethod() {
        $request = new Request('/test.php', 'foo');
    }

    /**
     * @testdox Properly adds a detector to the request.
     * @test
     */
    public function testAddDetector() {
        $request = new Request('/'); 
        $detector = $this->getMockForAbstractClass('Spice\Http\Request\Detector\DetectorInterface');
        $request->addDetector('detector', $detector);
        $this->assertAttributeEquals(array('detector' => $detector), 'detectors', $request);
    }

    /**
     * @testdox Properly removes a detector to the request.
     * @test
     */
    public function testRemoveDetector() {
        $request = new Request('/'); 
        $detector = $this->getMockForAbstractClass('Spice\Http\Request\Detector\DetectorInterface');
        $request->addDetector('detector', $detector);
        $request->removeDetector('detector');
        $this->assertAttributeEmpty('detectors', $request);
    }

    /**
     * @testdox Properly calls a valid detector when asked to do so.
     * @test
     */
    public function testValidDetectorCall() {
        $request = new Request('/'); 
        $detector = $this->getMockForAbstractClass('Spice\Http\Request\Detector\DetectorInterface');
        $detector->expects($this->at(0))
            ->method('matches')
            ->with($this->identicalTo($request))
            ->will($this->returnValue(true));
        $request->addDetector('detector', $detector);
        $this->assertTrue($request->is('detector'));
    }

    /**
     * @testdox Throws exception on try to call an unexistent detector.
     * @test
     * @expectedException InvalidArgumentException
     */
    public function testValidUnexistentDetectorCall() {
        $request = new Request('/'); 
        $this->assertTrue($request->is('detector'));
    }

    /**
     * @testdox Properly assembles the request to its string representation.
     * @test
     */
    public function testAssemble() {
        $request = new Request('/'); 
        $request->setHeader('Host', 'localhost');
        $request->setHeader('Accept', 'text/html');
        $request->setHeader('Accept-Encoding', 'gzip,deflate');
        $request->setBody('param1=value1&param2=value2');

        $expected = "GET / HTTP/1.1\r\nHost: localhost\r\nAccept: text/html\r\nAccept-Encoding: gzip,deflate\r\n\r\nparam1=value1&param2=value2";
        $this->assertEquals($expected, $request->assemble());
        $this->assertEquals($expected, (string) $request);
    }
}
