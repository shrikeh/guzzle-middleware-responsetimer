<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Handler;

use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger;

/**
 * Class StartHandler
 * @package Shrikeh\GuzzleMiddleware\TimerLogger
 */
class StartHandler
{
    /**
     * StopHandler constructor.
     *
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger $responseTimeLogger
     */
    public function __construct(ResponseTimeLogger $responseTimeLogger)
    {
        $this->responseTimeLogger = $responseTimeLogger;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     */
    public function __invoke(RequestInterface $request)
    {
        $this->responseTimeLogger->start($request);
    }
}
