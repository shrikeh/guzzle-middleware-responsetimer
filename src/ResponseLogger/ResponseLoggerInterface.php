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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Interface ResponseLoggerInterface.
 */
interface ResponseLoggerInterface
{
    /**
     * @param TimerInterface   $timer   A timer
     * @param RequestInterface $request The Request
     *
     * @return ResponseLoggerInterface
     *
     * @throws Exception\ResponseLogStartException On error
     */
    public function logStart(
        TimerInterface $timer,
        RequestInterface $request
    );

    /**
     * @param TimerInterface    $timer    A timer
     * @param RequestInterface  $request  The Request
     * @param ResponseInterface $response The Response
     *
     * @return ResponseLoggerInterface
     *
     * @throws Exception\ResponseLogStopException On error
     */
    public function logStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    );
}
