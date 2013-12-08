<?php
namespace Spice\Http\Response;

use Spice\Testing\BaseTestCase;

class ResponseTest extends BaseTestCase {
    /**
     * @testdox Properly creates the object.
     * @test
     */
    public function testCreationOk() {
        $response = new Response();
        $this->assertInstanceof('\Spice\Http\Response\ResponseInterface', $response);
        $this->assertInstanceof('\Spice\Http\AbstractMessage', $response);
    }

    /**
     * @testdox Properly parses response status and returns status code and reason phrase.
     * @test
     */
    public function testParseStatusAndReturnStatusCodeAndReasonPhrase() {
        $response = new Response(Status::OK);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('Ok', $response->getReasonPhrase());
    }

    /**
     * @testdox Properly assembles the response to it's string representation.
     * @test
     */
    public function testAssemble() {
        $response = new Response(Status::OK);
        $body = 'Ok';
        $len = strlen($body);
        $response->setBody($body);
        $response->setHeader('Content-Type', 'text/html');
        $response->setHeader('Content-Length', $len);
        $expected = "HTTP/1.1 200 Ok\r\nContent-Type: text/html\r\nContent-Length: $len\r\n\r\nOk";
        $this->assertEquals($expected, $response->assemble());
        $this->assertEquals($expected, (string) $response);
    }
}
