<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimersInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface;

/**
 * Class ResponseTimeLogger
 * @package Shrikeh\GuzzleMiddleware\TimerLogger
 */
class ResponseTimeLogger implements ResponseTimeLoggerInterface
{
    /**
     * @var \Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimersInterface
     */
    private $timers;

    /**
     * @var \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface
     */
    private $logger;

    public function __construct(
        RequestTimersInterface $timers,
        ResponseLoggerInterface $logger
    ) {
        $this->timers = $timers;
        $this->logger = $logger;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     */
    public function start(RequestInterface $request)
    {
        $this->logger->logStart(
            $this->timers->start($request),
            $request
        );
    }

    /**
     * @param \Psr\Http\Message\RequestInterface  $request
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function stop(RequestInterface $request, ResponseInterface $response)
    {
        $this->logger->logStop(
            $this->timers->stop($request),
            $request,
            $response
        );
    }
}
