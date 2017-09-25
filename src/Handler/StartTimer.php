<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Handler;

use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface;

/**
 * Class StartHandler
 */
class StartTimer
{
    /**
     * @var \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface
     */
    private $responseTimeLogger;

    /**
     * StartTimer constructor.
     *
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface $responseTimeLogger
     */
    public function __construct(ResponseTimeLoggerInterface $responseTimeLogger)
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
