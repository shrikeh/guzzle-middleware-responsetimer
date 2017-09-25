<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\FormatterInterface;
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
     * @var null|\Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\FormatterInterface
     */
    private $formatter;

    /**
     * ResponseLogger constructor.
     *
     * @param \Psr\Log\LoggerInterface                                           $logger
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\FormatterInterface $formatter
     */
    public function __construct(
        LoggerInterface $logger,
        FormatterInterface $formatter
    ) {
        $this->logger    = $logger;
        $this->formatter = $formatter;
    }

    /**
     * {@inheritdoc}
     */
    public function logStart(TimerInterface $timer, RequestInterface $request)
    {
        $this->logger->log(
            $this->formatter->levelStart($timer, $request),
            $this->formatter->start($timer, $request)
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function logStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $this->logger->log(
            $this->formatter->levelStop($timer, $request, $response),
            $this->formatter->stop($timer, $request, $response)
        );

        return $this;
    }
}
