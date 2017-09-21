<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Interface ResponseLoggerInterface
 * @package Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger
 */
interface ResponseLoggerInterface
{
    public function logStart(
        TimerInterface $timer,
        RequestInterface $request
    );

    public function logStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    );
}
