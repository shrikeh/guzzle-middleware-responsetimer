# Response timer for Guzzle
[![build_status_img]][build_status_travis]
[![sensiolabs_insight_img]][sensiolabs_insight]
[![code_quality_img]][code_quality]
[![latest_stable_version_img]][latest_stable_version]
[![versioneye_dependencies_img]][versioneye_dependencies]
[![license_img]][license]
[![twitter_img]][twitter]

A simple timer and logger that records response times for requests made by a [Guzzle] client to a [PSR-3] log. Created initially to help [Gousto] get an idea of how microservices were interacting and performing.

It has some advantages over some other timers that already existed, in that it natively supports asynchronous calls, and uses the `Request` object itself as the key, therefore allowing multiple calls to the same URI to be recorded separately.

## Installation

Installation is recommended via [composer]:

```bash
composer require shrikeh/guzzle-middleware-response-timer
```
## Requirements and versioning

If installed by composer, all requirements should be taken care of.
Semantic versioning is in use and strongly adhered to in tags 1.0 and beyond; branches before that are a little bit more free as I was shopping with ideas and the interface.

Tags <2.0 are 5.6 compatible; versions 2.0 and beyond are PHP 7.1+ only.

## Basic usage

The following is a simple example using the `quickStart()` method, which accepts a `Psr\Log\LoggerInterface` logger (in this case, a simple file stream implemented by [Monolog]):
```php
<?php
/**
 * @codingStandardsIgnoreStart
 *
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 *
 * @codingStandardsIgnoreEnd
 */

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Shrikeh\GuzzleMiddleware\TimerLogger\Middleware;

require_once __DIR__.'/../vendor/autoload.php';

$logFile = __DIR__.'/logs/example.log';
$logFile = new SplFileObject($logFile, 'w+');

// create a log channel
$log = new Logger('guzzle');
$log->pushHandler(new StreamHandler(
    $logFile->getRealPath(),
    Logger::DEBUG
));

// hand it to the middleware (this will create a default working example)
$middleware = Middleware::quickStart($log);

// now create a Guzzle middleware stack
$stack = HandlerStack::create();

// and register the middleware on the stack
$stack->push($middleware());

$config = [
    'timeout'   => 2,
    'handler' => $stack,
];

// then hand the stack to the client
$client = new Client($config);

$promises = [
    'facebook'  => $client->getAsync('https://www.facebook.com'),
    'wikipedia' => $client->getAsync('https://en.wikipedia.org/wiki/Main_Page'),
    'google'    => $client->getAsync('https://www.google.co.uk'),
];

$results = Promise\settle($promises)->wait();

print $logFile->fread($logFile->getSize());

```

## Exception handling

By default, the `Middleware::quickStart()` method boots the `start` and `stop` handlers with a `TriggerErrorHandler` that simply swallows any exception thrown and generates an `E_USER_NOTICE` error instead. 
This is to ensure that any problems with logging do not cause any application-level problems: there isn't a default scenario in which a problem logging response times _should_ break your application. Nor, as the exception is most likely to do with the underlying `Logger`, is there logging of the exception thrown.

If you wish to throw exceptions and handle them differently, load your handlers with an implementation of the `ExceptionHandlerInterface`.

[composer]: https://getcomposer.org
[PSR-3]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
[Guzzle]: http://docs.guzzlephp.org/en/stable/
[Monolog]: https://github.com/Seldaek/monolog
[Gousto]: https://www.gousto.co.uk/

[build_status_img]: https://img.shields.io/travis/shrikeh/guzzle-middleware-responsetimer.svg "Build Status"
[build_status_travis]: https://travis-ci.org/shrikeh/guzzle-middleware-responsetimer

[sensiolabs_insight_img]: https://img.shields.io/sensiolabs/i/769ed835-9e17-4a6f-ad45-7ae0c7734ccb.svg "SensioLabs Insight"
[sensiolabs_insight]: https://insight.sensiolabs.com/projects/769ed835-9e17-4a6f-ad45-7ae0c7734ccb

[code_quality]: https://scrutinizer-ci.com/g/shrikeh/guzzle-middleware-responsetimer/?branch=master
[code_quality_img]: https://img.shields.io/scrutinizer/g/shrikeh/guzzle-middleware-responsetimer.svg "Scrutinizer Code Quality"

[latest_stable_version_img]: https://img.shields.io/packagist/v/shrikeh/guzzle-middleware-response-timer.svg "Latest Stable Version"
[latest_stable_version]: https://packagist.org/packages/shrikeh/guzzle-middleware-response-timer "Latest Stable Version"

[versioneye_dependencies_img]: https://img.shields.io/versioneye/d/php/shrikeh/guzzle-middleware-responsetimer.svg
[versioneye_dependencies]: https://libraries.io/github/shrikeh/guzzle-middleware-responsetimer
[license_img]: https://img.shields.io/packagist/l/shrikeh/guzzle-middleware-response-timer.svg "License"
[license]: https://packagist.org/packages/shrikeh/guzzle-middleware-response-timer

[twitter_img]: https://img.shields.io/badge/twitter-%40shrikeh-blue.svg "@shrikeh on Twitter"
[twitter]: https://twitter.com/shrikeh

[examples]: https://github.com/shrikeh/guzzle-middleware-responsetimer/tree/master/examples "Link to examples in master"
[docs]: https://github.com/shrikeh/guzzle-middleware-responsetimer/tree/master/docs "Link to docs in master"
[specs]: https://github.com/shrikeh/guzzle-middleware-responsetimer/tree/master/tests/spec "Link to specs in master"
