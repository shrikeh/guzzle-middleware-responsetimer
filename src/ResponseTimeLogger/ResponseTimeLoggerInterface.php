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

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ResponseTimeLoggerInterface.
 */
interface ResponseTimeLoggerInterface
{
    /**
     * @param RequestInterface $request The Request to start timing
     */
    public function start(RequestInterface $request);

    /**
     * @param RequestInterface                                         $request  The Request to stop timing
     * @param ResponseInterface|\GuzzleHttp\Exception\ConnectException $response The associated Response
     */
    public function stop(RequestInterface $request, $response);
}
