<?php
namespace Spice\Http;

use Spice\Testing\BaseTestCase;

class AbstractMessageTest extends BaseTestCase {
    private $message;

    protected function getMessage() {
        return $this->getMockForAbstractClass('\\Spice\\Http\\AbstractMessage');
    }

    /**
     * @before
     */
    public function setUp() {
        $this->message = $this->getMessage();
    }

    /**
     * @testdox Default HTTP version is set to HTTP/1.1
     * @test
     */
    public function testDefaultHttpVersion() {
        $this->assertEquals(Version::HTTP_1_1, $this->message->getVersion());
    }

    /* /** */
    /*  * @testdox Default HTTP scheme is set to 'http' */
    /*  * @test */
    /*  *1/ */
    /* public function testDefaultHttpScheme() { */
    /*     $this->assertEquals(Scheme::HTTP, $this->message->getScheme()); */
    /* } */

    /**
     * @testdox Properly sets the HTTP version for the message
     * @test
     */
    public function testSetValidHttpVersion() {
        $this->message->setVersion(Version::HTTP_1_0);
        $this->assertAttributeEquals(Version::HTTP_1_0, 'version', $this->message);
    }

    /**
     * @testdox Fails on trying to set an invalid HTTP version for the message
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function testSetInvalidHttpVersionThrowsException() {
        $this->message->setVersion('anything');
    }

    /**
     * @testdox Properly normalizes a header name.
     * @test
     */
    public function testNormalizeHeaderName() {
        $this->assertEquals('Content-Type', 
            $this->invokeMethod(
                $this->message, 
                'normalizeHeaderName', 
                array('cOntent_TyPe')
            )
        );
    }

    /**
     * @testdox Properly sets and gets a header.
     * @test
     */
    public function testSetAndGetHeader() {
        $msg = $this->message->setHeader('content-type', 'text/html');    
        $this->assertEquals('text/html', $this->message->getHeader('content-type'));
        $this->assertSame($this->message, $msg);
    }

    /**
     * @testdox Properly sets an array of headers
     * @test
     */
    public function testSetAndGetArrayOfHeaders() {
        $headers = array(
            'content-type' => 'text/html',
            'user-agent' => 'mozilla',
        );

        $msg = $this->message->setHeaders($headers);

        $this->assertEquals('text/html', $this->message->getHeader('content-type'));
        $this->assertEquals('mozilla', $this->message->getHeader('user-agent'));
        $this->assertEmpty(array_diff($headers, $this->message->getAllHeaders()));

        $headers = array(
            'content-type' => 'text/plain',
            'user-agent' => 'mozilla',
        );
        $this->assertNotEmpty(array_diff($headers, $this->message->getAllHeaders()));
        $this->assertSame($this->message, $msg);
    }


    /**
     * @testdox Properly unsets a header
     * @test
     */
    public function testUnsetHeader() {
        $this->message->setHeader('content-type', 'text/html');
        $msg = $this->message->unsetHeader('content-type');

        $this->assertNull($this->message->getHeader('content-type'));
        $this->assertSame($this->message, $msg);
    }


    /**
     * @testdox Properly clears all headers from a message
     * @test
     **/
    public function testClearHeaders() {
        $headers = array(
            'content-type' => 'text/html',
            'user-agent' => 'mozilla',
        );

        $this->message->setHeaders($headers);
        $this->assertAttributeNotEmpty('headers', $this->message);

        $msg = $this->message->clearHeaders();
        $this->assertAttributeEmpty('headers', $this->message);
        $this->assertEmpty($this->message->getAllHeaders());

        $this->assertSame($this->message, $msg);
    }

    /**
     * @testdox Properly sets and gets the body of a message
     * @test
     */
    public function testSetAndGetBody() {
        $this->assertEmpty($this->message->getBody());

        $msg = $this->message->setBody('content');

        $this->assertAttributeEquals('content', 'body', $this->message);
        $this->assertEquals('content', $this->message->getBody());
        $this->assertSame($this->message, $msg);
    }

    /**
     * @testdox Properly appends data to the message body
     * @test
     */
    public function testAppendBody() {
        $this->message->appendBody('Hello');
        $msg = $this->message->appendBody(' World');

        $this->assertEquals('Hello World', $this->message->getBody());
        $this->assertSame($this->message, $msg);
    }

    /**
     * @testdox Properly prepends data to the message body
     * @test
     */
    public function testPrependBody() {
        $this->message->prependBody(' World');
        $msg = $this->message->prependBody('Hello');

        $this->assertEquals('Hello World', $this->message->getBody());
        $this->assertSame($this->message, $msg);
    }

    /**
     * @testdox Properly clears the message body
     * @test
     */
    public function testClearBody() {
        $this->message->setBody('content');
        $msg = $this->message->clearBody();
        $this->assertEmpty($this->message->getBody());
        $this->assertSame($this->message, $msg);
    }

    /**
     * @testdox Properly assembles message headers.
     * @test
     */
    public function testAssembleHeaders() {
        $expected = "Content-Type: text/html\r\nConnection: keep-alive\r\n"; 
        $this->message->setHeader('content-type', 'text/html');
        $this->message->setHeader('connection', 'keep-alive');

        $this->assertEquals(
            $expected, 
            $this->invokeMethod(
                $this->message, 
                'assembleHeaders'
            )
        );
    }

}
