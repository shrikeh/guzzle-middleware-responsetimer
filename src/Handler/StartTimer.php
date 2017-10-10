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
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\Traits\HandlerStaticConstructorTrait;

/**
 * Class StartHandler.
 */
class StartTimer
{
    use HandlerStaticConstructorTrait;

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
