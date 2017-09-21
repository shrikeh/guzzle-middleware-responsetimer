<?php
namespace Shrikeh\GuzzleMiddleware\TimerLogger;

use Psr\Log\LoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\StartTimer;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\StopTimer;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimers;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLogger;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface;

/**
 * Class Middleware
 * @package Shrikeh\GuzzleMiddleware\TimerLogger
 */
class Middleware
{
    /**
     * @var callable
     */
    private $startHandler;

    /**
     * @var callable
     */
    private $stopHandler;

    public static function quickStart(ResponseTimeLoggerInterface $responseTimeLogger)
    {
        return new self(
            new StartTimer($responseTimeLogger),
            new StopTimer($responseTimeLogger)
        );
    }


    /**
     * Middleware constructor.
     *
     * @param callable $startHandler
     * @param callable $stopHandler
     */
    public function __construct(callable $startHandler, callable $stopHandler)
    {
        $this->startHandler = $startHandler;
        $this->stopHandler = $stopHandler;
    }


    public function __invoke()
    {
        return $this->tap();
    }

    public function tap()
    {
        return \GuzzleHttp\Middleware::tap($this->startHandler, $this->stopHandler);
    }
}
