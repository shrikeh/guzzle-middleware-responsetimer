<?php
/**
 * @codingStandardsIgnoreStart
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 * @codingStandardsIgnoreEnd
 */
namespace Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers;

use Psr\Http\Message\RequestInterface;

/**
 * Interface RequestTimersInterface.
 */
interface RequestTimersInterface
{
    /**
     * @param RequestInterface $request The Request to start timing
     *
     * @return TimerInterface
     */
    public function start(RequestInterface $request);

    /**
     * @param RequestInterface $request The Request to stop timing
     *
     * @return TimerInterface
     */
    public function stop(RequestInterface $request);

    /**
     * @param RequestInterface $request The Request to return the duration for
     *
     * @return float
     */
    public function duration(RequestInterface $request);
}
