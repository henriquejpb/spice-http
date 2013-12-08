<?php
/**
 * Default implementation for HTTP Response objects.
 *
 * @package Spice\Http\Response
 */
namespace Spice\Http\Response;

use Spice\Http\AbstractMessage;
use Spice\Http\Version;

/**
 * Represents and HTTP Response.
 */
class Response extends AbstractMessage implements ResponseInterface {
    /**
     * @var int the response status code.
     */
    private $statusCode;

    /**
     * @var string the response reason phrase.
     */
    private $reasonPhrase;

    /**
     * Creates a Response object.
     *
     * @param string $status one of Spice\Http\Response\Status constants.
     * @param string $version one of Spice\Http\Version constants.
     */
    public function __construct($status = Status::OK, $httpVersion = Version::HTTP_1_1) {
        list($code, $phrase) = sscanf($status, "%d %s");
        $this->statusCode = (int) $code;
        $this->reasonPhrase =& $phrase;
        parent::__construct($httpVersion);
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\Response\ResponseInterface::getStatusCode()
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\Response\ResponseInterface::getStatusCode()
     */
    public function getReasonPhrase() {
        return $this->reasonPhrase;
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\MessageInterface::assemble()
     */
    public function assemble() {
        $resText = $this->getVersion() . ' ' . $this->statusCode . ' ' 
                 . $this->reasonPhrase . "\r\n";
        $resText .= $this->assembleHeaders(); 
        $resText .= "\r\n";
        $resText .= $this->getBody();
        return $resText;
    }

    /**
     * {@inherit-doc}
     *
     * @see Spice\Http\MessageInterface::__toString()
     */
    public function __toString() {
        return $this->assemble();
    }
}
