<?php
/**
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers;

use Psr\Http\Message\RequestInterface;

/**
 * Interface RequestTimersInterface.
 */
interface RequestTimersInterface
{
    /**
     * @param \Psr\Http\Message\RequestInterface $request The Request to start timing
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface
     */
    public function start(RequestInterface $request);

    /**
     * @param \Psr\Http\Message\RequestInterface $request The Request to stop timing
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface
     */
    public function stop(RequestInterface $request);

    /**
     *
     * @param \Psr\Http\Message\RequestInterface $request The Request to return the duration for
     * @return float
     */
    public function duration(RequestInterface $request);
}
