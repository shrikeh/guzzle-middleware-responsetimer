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
     * @param LoggerInterface $logger The PSR-3 LoggerInterface
     *
     * @return self
     */
    public static function quickStart(LoggerInterface $logger)
    {
        return self::fromResponseTimeLogger(ResponseTimeLogger::quickStart($logger));
    }

    /**
     * @param ResponseTimeLoggerInterface $responseTimeLogger A timer logger
     *
     * @return self
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
     * @param callable $startHandler A start handler to register
     * @param callable $stopHandler  A stop handler to register
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
