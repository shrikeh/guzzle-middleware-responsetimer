<?php
/**
 * @codingStandardsIgnoreStart
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
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
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer   A timer
     * @param \Psr\Http\Message\RequestInterface                         $request The Request
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface
     */
    public function logStart(
        TimerInterface $timer,
        RequestInterface $request
    );

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer    A timer
     * @param \Psr\Http\Message\RequestInterface                         $request  The Request
     * @param \Psr\Http\Message\ResponseInterface                        $response The Response
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface
     */
    public function logStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    );
}
