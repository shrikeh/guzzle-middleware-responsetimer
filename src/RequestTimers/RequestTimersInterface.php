<?php
namespace Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface RequestTimersInterface
 */
interface RequestTimersInterface
{
    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface
     */
    public function start(RequestInterface $request);

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface
     */
    public function stop(RequestInterface $request);

    /**
     * @return float
     */
    public function duration(RequestInterface $request);
}
