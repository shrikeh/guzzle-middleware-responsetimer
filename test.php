<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Shrikeh\GuzzleMiddleware\TimerLogger\LogFormatter;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\StartHandler;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\StopHandler;

require_once __DIR__.'/vendor/autoload.php';

$timer = new RequestTimers();

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('path/to/your.log', Logger::DEBUG));

$formatter = new LogFormatter();
$logger = new \Shrikeh\GuzzleMiddleware\TimerLogger\Logger($log, $formatter);

$responseTimeLogger = new ResponseTimeLogger($timer, $logger);

$requestTimeBefore = new StartHandler($responseTimeLogger);
$requestTimeAfter = new StopHandler($responseTimeLogger);

$stack = new HandlerStack();
$stack->setHandler(\GuzzleHttp\choose_handler());
$stack->push(Middleware::tap($requestTimeBefore, $requestTimeAfter));

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



