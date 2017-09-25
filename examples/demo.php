<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Verbose;
use Shrikeh\GuzzleMiddleware\TimerLogger\Middleware;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLogger;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLogger;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

require_once __DIR__.'/../vendor/autoload.php';


// create a log channel
$log = new Logger('guzzle');
$log->pushHandler(new StreamHandler(
    __DIR__.'/logs/example.log',
    Logger::DEBUG
));

$startMsg = function (
    TimerInterface $timer,
    RequestInterface $request
    ) {
    $msg = 'Started call to %s at %s';

    return sprintf(
        $msg,
        $request->getUri(),
        $timer->start()->format('Y-m-d H:i:s')
    );
};

$stopMsg = function (
    TimerInterface $timer,
    RequestInterface $request,
    ResponseInterface $response
    ) {
    $msg = 'Completed call to %s in %dms with response code %d';

    return sprintf(
        $msg,
        $request->getUri(),
        $timer->duration(),
        $response->getStatusCode()
    );
};

$formatter          = Verbose::fromCallables($startMsg, $stopMsg);
$responseTimeLogger = ResponseTimeLogger::createFrom(
    new ResponseLogger($log, $formatter)
);
$middleware = Middleware::quickStart(
    $responseTimeLogger
);

$stack = HandlerStack::create();

$stack->push($middleware());

$client = new Client(['handler' => $stack]);

$request1 = new Request('GET', 'https://www.facebook.com');
$request2 = new Request('GET', 'https://en.wikipedia.org/wiki/Main_Page');
$request3 = new Request('GET', 'https://www.google.co.uk');

$promises = [
    $client->sendAsync($request1),
    $client->sendAsync($request2),
    $client->sendAsync($request3)
];

$results = Promise\settle($promises)->wait();



