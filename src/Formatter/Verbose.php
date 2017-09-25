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
     * @var RequestStartInterface
     */
    private $start;

    /**
     * @var RequestStopInterface
     */
    private $stop;

    public static function fromCallables(
        callable $start,
        callable $stop,
        $startLevel = LogLevel::DEBUG,
        $stopLevel = LogLevel::DEBUG
    ) {
        return new self(
            new StartFormatter($start, $startLevel),
            new StopFormatter($stop, $stopLevel)
        );
    }

    /**
     * Verbose constructor.
     *
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\RequestStartInterface $start
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\RequestStopInterface  $stop
     */
    public function __construct(
        RequestStartInterface $start,
        RequestStopInterface $stop
    ) {
        $this->start = $start;
        $this->stop = $stop;
    }

    /**
     * @return string
     */
    public function levelStart(TimerInterface $timer, RequestInterface $request)
    {
        return $this->start->levelStart($timer, $request);
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     *
     * @return string
     */
    public function start(TimerInterface $timer, RequestInterface $request)
    {
        return $this->start->start($timer, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function levelStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        return $this->stop->levelStop($timer, $request, $response);
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
        return $this->stop->stop($timer, $request, $response);
    }
}
