<?php
/**
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Interface RequestStartInterface.
 */
interface RequestStopInterface
{
    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     * @param \Psr\Http\Message\ResponseInterface                        $response
     *
     * @return mixed
     */
    public function stop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    );

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     * @param \Psr\Http\Message\ResponseInterface                        $response
     *
     * @return string
     */
    public function levelStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    );
}
