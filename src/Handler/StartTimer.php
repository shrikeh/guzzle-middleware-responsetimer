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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Handler;

use Exception;
use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler\ExceptionHandlerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface;

/**
 * Class StartHandler.
 */
class StartTimer
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
     * StartTimer constructor.
     *
     * @param ResponseTimeLoggerInterface $responseTimeLogger A logger for logging the response start
     * @param ExceptionHandlerInterface $exceptionHandler A handler for exceptions
     */
    public function __construct(
        ResponseTimeLoggerInterface $responseTimeLogger,
        ExceptionHandlerInterface $exceptionHandler
    ) {
        $this->responseTimeLogger = $responseTimeLogger;
        $this->exceptionHandler   = $exceptionHandler;
    }

    /**
     * @param RequestInterface $request The Request to start timing
     */
    public function __invoke(RequestInterface $request)
    {
        try {
            $this->responseTimeLogger->start($request);
        } catch (Exception $e) {
            // Pass the exception to the handler
            $this->exceptionHandler->handle($e);
        }

    }
}
