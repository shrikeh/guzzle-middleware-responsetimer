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
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\Traits\HandlerStaticConstructorTrait;

/**
 * Class StartHandler.
 */
final class StopTimer
{
    use HandlerStaticConstructorTrait;

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

        return function ($response) use ($request, $exceptionHandler) {
            try {
                $this->responseTimeLogger->stop($request, $response);
            } catch (Exception $e) {
                $exceptionHandler->handle($e);
            }
        };
    }
}
