<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger;

use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;

/**
 * Class LogFormatter
 * @package Shrikeh\GuzzleMiddleware\TimerLogger
 */
class LogFormatter
{
    /**
     * @return string
     */
    public function levelStart()
    {
        return LogLevel::DEBUG;
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer $timer
     * @param \Psr\Http\Message\ResponseInterface         $response
     *
     * @return string
     */
    public function levelStop(Timer $timer, ResponseInterface $response)
    {
        return LogLevel::DEBUG;
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer $timer
     *
     * @return string
     */
    public function start(Timer $timer)
    {
        $msg = 'Started call to %s at %s';
        return sprintf($msg, $this->uri($timer), $this->time($timer));
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer $timer
     * @param \Psr\Http\Message\ResponseInterface         $response
     *
     * @return string
     */
    public function stop(Timer $timer, ResponseInterface $response)
    {
        $msg = 'Completed call to %s in %dms with response code %d';
        return sprintf(
            $msg,
            $this->uri($timer),
            $timer->duration(),
            $response->getStatusCode()
        );

    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer $timer
     *
     * @return \Psr\Http\Message\UriInterface
     */
    private function uri(Timer $timer)
    {
        return $timer->request()->getUri();
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer $timer
     *
     * @return string
     */
    private function time(Timer $timer)
    {
        return $timer->start()->format('Y-m-d H:i:s');
    }
}
