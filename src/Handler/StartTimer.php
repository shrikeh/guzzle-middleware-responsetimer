<?php
/**
 * @codingStandardsIgnoreStart
 *
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 * @codingStandardsIgnoreEnd
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Handler;

use Psr\Http\Message\RequestInterface;
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
     * StartTimer constructor.
     *
     * @param ResponseTimeLoggerInterface $responseTimeLogger A logger for logging the response start
     */
    public function __construct(ResponseTimeLoggerInterface $responseTimeLogger)
    {
        $this->responseTimeLogger = $responseTimeLogger;
    }

    /**
     * @param RequestInterface $request The Request to start timing
     */
    public function __invoke(RequestInterface $request)
    {
        $this->responseTimeLogger->start($request);
    }
}
