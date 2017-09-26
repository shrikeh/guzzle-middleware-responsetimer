<?php
/**
 * @codingStandardsIgnoreStart
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
