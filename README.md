# spice-http [![Build Status](https://travis-ci.org/henriquejpb/spice-http.png?branch=master)](https://travis-ci.org/henriquejpb/spice-http)

HTTP module of the Spice framework.

This module attempts to represent some HTTP components as PHP Objects in order to ease request handling.

For performance and simplicity sake, this implementation is as basic as it can be. 
Therefore, no validation is done on headers names or values, for example.

However, it does validates essential parts of the protocol, such as version and structure.

In other words, this implementation assumes that the programmer knows the basics of HTTP protocol and its messages.

For more details, refer to the [RFC](http://www.w3.org/Protocols/rfc2616/rfc2616-sec5.html#sec).

## Components

### Spice\Http\MessageInterface
Represents the common behaviour of both HTTP requests and responses, such as setting headers and body content.

#### Considerations about headers
Like explained before, no checks will be done in headers names or values. It's up to the programmer to set proper headers, observing HTTP versions differences.

When setting headers, try to use hyphenised lowercase names like `'content-type'`, although the following formats and its variations are also accepted:

 - `'Content-Type'`
 - `'Content_Type'`
 - `'content_Type'` 

### Spice\Http\Version

This is a simple enumeration containing a reference to the existent HTTP versions. They are:

```php
Spice\Http\Version::HTTP_1_0; // For HTTP 1.0
Spice\Http\Version::HTTP_1_1; // For HTTP 1.1
``` 

By default, all messages use the `HTTP 1.1` version.

### Spice\Http\Request
#### Spice\Http\Request\RequestInterface

Represents an HTTP client request.

The default implementation is `Spice\Http\Request\Request`.

#### Spice\Http\Request\Method

Enumeration holding the HTTP available methods (verbs).
___ 

**Usage:**

There is only one mandatory parameter for `Spice\Http\Request\Request` constructor: the resource URI to be fetched.

```php
use Spice\Http\Request\Request;
use Spice\Http\Request\Method;
use Spice\Http\Version;

// Creates a GET request to the web root of the application using HTTP 1.1
$request = new Request('/');

// Creates a POST request to the web root of the application using HTTP 1.1
$request = new Request('/', Method::POST);

// Creates a POST request to the web root of the application using HTTP 1.0
$request = new Request('/', Method::POST, Version::HTTP_1_0);

// Creates a POST request with the current GET parameters:
$request = new Request('/', Method::POST);

// mandatory if sending url encoded query string in the body
$request->setHeader('content-type', 'application/x-www-form-urlencoded'); 
$request->appendBody(http_build_query($_GET));

```
___

#### Detectors
Detectors provide an easy and extensible way of determining if a request matches some conditions, like if it's a `POST` request, if it was made via `XMLHTTPRequest` object (aka Ajax).

```php
use Spice\Http\Request\Request;
use Spice\Http\Request\Method;
use Spice\Http\Request\Request\Detector\Method as MethodDetector;

$request = new Request('/', Method::POST);
$request->addDetector('post', new MethodDetector('POST'));

var_dump($request->is('post')); // bool(true)
```
Default detectors:

 - `Ajax`: detects if a request was made via `XMLHTTPRequest`
 - `Mobile`: detects if a request was made by a mobile device
 - `Flash`: detects if a request was made by a flash object
 - `Method`: detects if a request has a specified method.
 
### Spice\Http\Response
 
#### Spice\Http\Response\ResponseInterface
Represents an HTTP server response.
 
The default implementation is `Spice\Http\Response\Response`.
 
#### Spice\Http\Response\Status
Enumeration containing HTTP response statuses in the format `<status_code> <status_phrase>`.
 
___
 
**Usage:**
 
`Spice\Http\Response\Response` has no mandatory parameters. By default it's created an `200 Ok` response using HTTP 1.1.
 
```php
use Spice\Http\Response\Response;
use Spice\Http\Response\Status;
use Spice\Http\Version;
 
// Creates a '200 Ok' response using HTTP 1.1
$response = new Response(Status::OK); // This parameter is optional

// Creates a '404 Not Found' response using HTTP 1.1
$response = new Response(Status::NOT_FOUND);

// Creates a '404 Not Found' response using HTTP 1.0
$response = new Response(Status::NOT_FOUND, Version::HTTP_1_0);

// Creating a HTML response for the current request:
$response = new Response();
$response->setHeader('content-type', 'text/html;charset=UTF-8');
$response->appendBody('<!doctype html>(...)');

// Creating a  JSON response for the current request:
$response = new Response();
$response->setHeader('content-type', 'application/json');
$response->appendBody(json_encode(...));
```
