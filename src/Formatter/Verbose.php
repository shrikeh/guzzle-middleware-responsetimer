<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class Verbose
 * @package Shrikeh\GuzzleMiddleware\TimerLogger
 */
class Verbose implements FormatterInterface
{
    /**
     * @return string
     */
    public function levelStart()
    {
        return LogLevel::DEBUG;
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\ResponseInterface                        $response
     *
     * @return string
     */
    public function levelStop(TimerInterface $timer, ResponseInterface $response)
    {
        return LogLevel::DEBUG;
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     *
     * @return string
     */
    public function start(TimerInterface $timer, RequestInterface $request)
    {
        $msg = 'Started call to %s at %s';
        return sprintf($msg, $request->getUri(), $this->time($timer));
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     * @param \Psr\Http\Message\ResponseInterface                        $response
     *
     * @return string
     */
    public function stop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $msg = 'Completed call to %s in %dms with response code %d';

        return sprintf(
            $msg,
            $request->getUri(),
            $timer->duration(),
            $response->getStatusCode()
        );
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     *
     * @return string
     */
    private function time(TimerInterface $timer)
    {
        return $timer->start()->format('Y-m-d H:i:s');
    }
}
