<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Verbose;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class ResponseLogger
 * @package Shrikeh\GuzzleMiddleware\TimerLogger
 */
class ResponseLogger implements ResponseLoggerInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;
    /**
     * @var \Shrikeh\GuzzleMiddleware\TimerLogger\LogFormatter
     */
    private $formatter;

    /**
     * ResponseLogger constructor.
     *
     * @param \Psr\Log\LoggerInterface                                $logger
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\LogFormatter|null $formatter
     */
    public function __construct(
        LoggerInterface $logger,
        Verbose $formatter = null
    ) {

        $this->logger    = $logger;
        $this->formatter = $formatter;
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     *
     * @return $this
     */
    public function logStart(TimerInterface $timer, RequestInterface $request)
    {
        $this->logger->log(
            $this->formatter->levelStart(),
            $this->formatter->start($timer, $request)
        );

        return $this;
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     * @param \Psr\Http\Message\ResponseInterface                        $response
     */
    public function logStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $this->logger->log(
            $this->formatter->levelStop($timer, $response),
            $this->formatter->stop($timer, $request, $response)
        );
    }
}
