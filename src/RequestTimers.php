<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger;

use Ds\Map;
use Psr\Http\Message\RequestInterface;

/**
 * Class TimerHandler
 */
class RequestTimers
{
    /**
     * @var \Ds\Map
     */
    private $requestTimers;

    /**
     * TimerHandler constructor.
     */
    public function __construct()
    {
        $this->requestTimers = new Map();
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return mixed
     */
    public function start(RequestInterface $request)
    {
        if (!$this->requestTimers->hasKey($request)) {
            $this->requestTimers->put($request, new Timer($request));
        }
        $timer = $this->timerFor($request);
        $timer->start();

        return $timer;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return mixed
     */
    public function stop(RequestInterface $request)
    {
        $timer = $this->timerFor($request);
        $timer->stop();

        return $timer;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Litipk\BigNumbers\Decimal
     */
    public function duration(RequestInterface $request)
    {
        return $this->timerFor($request)->duration();
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Timer
     */
    public function timerFor(RequestInterface $request): Timer
    {
        return $this->requestTimers->get($request);
    }
}
