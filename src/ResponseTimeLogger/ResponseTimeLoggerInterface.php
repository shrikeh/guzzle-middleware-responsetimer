<?php
/**
 * @codingStandardsIgnoreStart
 *
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
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
     * @param \Psr\Http\Message\RequestInterface $request The Request to start timing
     */
    public function start(RequestInterface $request);

    /**
     * @param \Psr\Http\Message\RequestInterface  $request  The Request to stop timing
     * @param \Psr\Http\Message\ResponseInterface $response The associated Response
     */
    public function stop(RequestInterface $request, ResponseInterface $response);
}
