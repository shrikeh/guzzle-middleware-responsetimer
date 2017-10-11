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

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\FormatterInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Verbose;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimers;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimersInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLogger;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\Exception\TimersException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class ResponseTimeLogger.
 */
final class ResponseTimeLogger implements ResponseTimeLoggerInterface
{
    /**
     * @var RequestTimersInterface
     */
    private $timers;

    /**
     * @var \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface
     */
    private $logger;

    /**
     * @param \Psr\Log\LoggerInterface $logger    A logger to log to
     * @param FormatterInterface       $formatter An optional formatter
     *
     * @return ResponseTimeLogger
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
            $this->startTimer($request),
            $request
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stop(RequestInterface $request, ResponseInterface $response)
    {
        $this->logger->logStop(
            $this->stopTimer($request),
            $request,
            $response
        );
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request The Request
     *
     * @return TimerInterface
     *
     * @throws TimersException if there is a problem starting the timer
     */
    private function startTimer(RequestInterface $request)
    {
        try {
            return $this->timers->start($request);
        } catch (Exception $e) {
            throw TimersException::start($e);
        }
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request The Request
     *
     * @return TimerInterface
     *
     * @throws TimersException if there is a problem stopping the timer
     */
    private function stopTimer(RequestInterface $request)
    {
        try {
            return $this->timers->stop($request);
        } catch (Exception $e) {
            throw TimersException::stop($e);
        }
    }
}
