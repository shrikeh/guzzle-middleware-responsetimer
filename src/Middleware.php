<?php
/**
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger;

use Psr\Log\LoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\StartTimer;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\StopTimer;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLogger;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface;

/**
 * Class Middleware.
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

    /**
     * @param \Psr\Log\LoggerInterface $logger The PSR-3 LoggerInterface
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Middleware
     */
    public static function quickStart(LoggerInterface $logger)
    {
        return self::fromResponseTimeLogger(ResponseTimeLogger::quickStart($logger));
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface $responseTimeLogger A timer
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Middleware
     */
    public static function fromResponseTimeLogger(ResponseTimeLoggerInterface $responseTimeLogger)
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

    /**
     * @return callable
     */
    public function __invoke()
    {
        return $this->tap();
    }

    /**
     * @return callable
     */
    public function tap()
    {
        return \GuzzleHttp\Middleware::tap($this->startHandler, $this->stopHandler);
    }
}
