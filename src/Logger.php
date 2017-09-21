<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger;


use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

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

    public function __construct(
        LoggerInterface $logger,
        LogFormatter $formatter = null
    ) {

        $this->logger    = $logger;
        $this->formatter = $formatter;
    }

    public function logStart(Timer $timer)
    {
        $this->logger->log(
            $this->formatter->levelStart(),
            $this->formatter->start($timer)
        );
    }

    public function logStop(Timer $timer, ResponseInterface $response)
    {
        $this->logger->log(
            $this->formatter->levelStop($timer, $response),
            $this->formatter->stop($timer, $response)
        );
    }
}
