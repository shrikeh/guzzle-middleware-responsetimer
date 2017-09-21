<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ResponseTimeLogger
 * @package Shrikeh\GuzzleMiddleware\TimerLogger
 */
class ResponseTimeLogger
{
    /**
     * @var \Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers
     */
    private $timers;
    /**
     * @var \Shrikeh\GuzzleMiddleware\TimerLogger\Logger
     */
    private $logger;

    /**
     * ResponseTimeLogger constructor.
     *
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers $timers
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Logger        $logger
     */
    public function __construct(RequestTimers $timers, Logger $logger)
    {
        $this->timers = $timers;
        $this->logger = $logger;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     */
    public function start(RequestInterface $request)
    {
        $this->logger->logStart($this->timers->start($request));
    }

    /**
     * @param \Psr\Http\Message\RequestInterface  $request
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function stop(RequestInterface $request, ResponseInterface $response)
    {
        $this->logger->logStop(
            $this->timers->stop($request),
            $response
        );
    }
}
