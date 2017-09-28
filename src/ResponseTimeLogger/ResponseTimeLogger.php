<?php
/**
 * @codingStandardsIgnoreStart
 *
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 *
 * @codingStandardsIgnoreEnd
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\FormatterInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Verbose;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimers;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimersInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLogger;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface;

/**
 * Class ResponseTimeLogger.
 */
class ResponseTimeLogger implements ResponseTimeLoggerInterface
{
    /**
     * @var \Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimersInterface
     */
    private $timers;

    /**
     * @var \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface
     */
    private $logger;

    /**
     * @param \Psr\Log\LoggerInterface                                           $logger    A logger to log to
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\FormatterInterface $formatter An optional formatter
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLogger
     */
    public static function quickStart(
        LoggerInterface $logger,
        FormatterInterface $formatter = null
    ) {
        if (!$formatter) {
            $formatter = Verbose::quickStart();
        }

        return self::createFrom(new ResponseLogger($logger, $formatter));
    }

    /**
     * @param ResponseLoggerInterface     $logger a logger to log to
     * @param RequestTimersInterface|null $timers An optional timers collection
     *
     * @return ResponseTimeLogger
     */
    public static function createFrom(
        ResponseLoggerInterface $logger,
        RequestTimersInterface $timers = null
    ) {
        if (!$timers) {
            $timers = new RequestTimers();
        }

        return new self($timers, $logger);
    }

    /**
     * @param RequestTimersInterface  $timers A timers collection
     * @param ResponseLoggerInterface $logger a logger to log to
     */
    public function __construct(
        RequestTimersInterface $timers,
        ResponseLoggerInterface $logger
    ) {
        $this->timers = $timers;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function start(RequestInterface $request)
    {
        $this->logger->logStart(
            $this->timers->start($request),
            $request
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stop(RequestInterface $request, ResponseInterface $response)
    {
        $this->logger->logStop(
            $this->timers->stop($request),
            $request,
            $response
        );
    }
}
