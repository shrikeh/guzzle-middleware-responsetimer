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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Handler\Traits;

use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler\ExceptionHandlerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler\TriggerErrorHandler;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface;

/**
 * Trait HandlerStaticConstructorTrait.
 */
trait HandlerStaticConstructorTrait
{
    /**
     * @var ResponseTimeLoggerInterface
     */
    private $responseTimeLogger;

    /**
     * @var ExceptionHandlerInterface
     */
    private $exceptionHandler;

    /**
     * @param ResponseTimeLoggerInterface    $responseTimeLogger A logger for logging the response start
     * @param ExceptionHandlerInterface|null $exceptionHandler   An optional handler for exceptions
     *
     * @return callable
     */
    public static function createFrom(
        ResponseTimeLoggerInterface $responseTimeLogger,
        ExceptionHandlerInterface $exceptionHandler = null
    ) {
        if (!$exceptionHandler) {
            $exceptionHandler = new TriggerErrorHandler();
        }

        return new static($responseTimeLogger, $exceptionHandler);
    }

    /**
     * Handler constructor.
     *
     * @param ResponseTimeLoggerInterface $responseTimeLogger A logger for logging the response start
     * @param ExceptionHandlerInterface   $exceptionHandler   A handler for exceptions
     */
    public function __construct(
        ResponseTimeLoggerInterface $responseTimeLogger,
        ExceptionHandlerInterface $exceptionHandler
    ) {
        $this->responseTimeLogger = $responseTimeLogger;
        $this->exceptionHandler = $exceptionHandler;
    }
}
