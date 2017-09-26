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
use GuzzleHttp\Psr7\Request;
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

$request1 = new Request('GET', 'https://www.facebook.com');
$request2 = new Request('GET', 'https://en.wikipedia.org/wiki/Main_Page');
$request3 = new Request('GET', 'https://www.google.co.uk');

$promises = [
    $client->sendAsync($request1),
    $client->sendAsync($request2),
    $client->sendAsync($request3)
];

$results = Promise\settle($promises)->wait();

print $logFile->fread($logFile->getSize());
