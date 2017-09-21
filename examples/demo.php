<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Verbose;
use Shrikeh\GuzzleMiddleware\TimerLogger\Middleware;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLogger;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLogger;

require_once __DIR__.'/../vendor/autoload.php';


// create a log channel
$log = new Logger('guzzle');
$log->pushHandler(new StreamHandler(__DIR__.'/logs/example.log', Logger::DEBUG));



$formatter = new Verbose();
$responseTimeLogger = ResponseTimeLogger::createFrom(
    new ResponseLogger($log, $formatter)
);
$middleware = Middleware::quickStart(
    $responseTimeLogger
);

$stack = new HandlerStack();
$stack->setHandler(\GuzzleHttp\choose_handler());
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



