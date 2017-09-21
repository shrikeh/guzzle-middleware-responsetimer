<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger;


use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Logger
 * @package Shrikeh\GuzzleMiddleware\TimerLogger
 */
class Logger
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
     * Logger constructor.
     *
     * @param \Psr\Log\LoggerInterface                                $logger
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\LogFormatter|null $formatter
     */
    public function __construct(
        LoggerInterface $logger,
        LogFormatter $formatter = null
    ) {

        $this->logger    = $logger;
        $this->formatter = $formatter;
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer $timer
     *
     * @return $this
     */
    public function logStart(Timer $timer)
    {
        $this->logger->log(
            $this->formatter->levelStart(),
            $this->formatter->start($timer)
        );

        return $this;
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer $timer
     * @param \Psr\Http\Message\ResponseInterface         $response
     */
    public function logStop(Timer $timer, ResponseInterface $response)
    {
        $this->logger->log(
            $this->formatter->levelStop($timer, $response),
            $this->formatter->stop($timer, $response)
        );
    }
}
