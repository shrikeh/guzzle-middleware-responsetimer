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
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler\ExceptionHandlerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler\TriggerErrorHandler;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface;

/**
 * Class StartHandler.
 */
class StopTimer
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
     * @return StopTimer
     */
    public static function createFrom(
        ResponseTimeLoggerInterface $responseTimeLogger,
        ExceptionHandlerInterface $exceptionHandler = null
    ) {
        if (!$exceptionHandler) {
            $exceptionHandler = new TriggerErrorHandler();
        }

        return new self($responseTimeLogger, $exceptionHandler);
    }

    /**
     * StopTimer constructor.
     *
     * @param ResponseTimeLoggerInterface $responseTimeLogger The logger for the Response
     * @param ExceptionHandlerInterface   $exceptionHandler   An exception handler
     */
    public function __construct(
        ResponseTimeLoggerInterface $responseTimeLogger,
        ExceptionHandlerInterface $exceptionHandler
    ) {
        $this->responseTimeLogger = $responseTimeLogger;
        $this->exceptionHandler = $exceptionHandler;
    }

    /**
     * @param RequestInterface $request The Request to stop timing
     * @param array            $options An ignorable list of options
     * @param PromiseInterface $promise A Promise to fulfill
     */
    public function __invoke(
        RequestInterface $request,
        array $options,
        PromiseInterface $promise
    ) {
        $closure = $this->closure($request);
        $promise->then(
            $closure,
            $closure
        );
    }

    /**
     * @param RequestInterface $request The Request being timed
     *
     * @return callable|\Closure
     */
    private function closure(RequestInterface $request)
    {
        $exceptionHandler = $this->exceptionHandler;

        return function (ResponseInterface $response) use ($request, $exceptionHandler) {
            try {
                $this->responseTimeLogger->stop($request, $response);
            } catch (Exception $e) {
                $exceptionHandler->handle($e);
            }
        };
    }
}
