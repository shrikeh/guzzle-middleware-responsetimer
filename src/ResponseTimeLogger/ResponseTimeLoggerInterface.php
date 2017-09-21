<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ResponseTimeLoggerInterface
 * @package Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger
 */
interface ResponseTimeLoggerInterface
{
    /**
     * @param \Psr\Http\Message\RequestInterface $request
     */
    public function start(RequestInterface $request);

    /**
     * @param \Psr\Http\Message\RequestInterface  $request
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function stop(RequestInterface $request, ResponseInterface $response);
}
