<?php
/**
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Timer;

/**
 * Interface TimerInterface.
 */
interface TimerInterface
{
    /**
     * @return \DateTimeImmutable
     */
    public function start();

    /**
     * @return \DateTimeImmutable
     */
    public function stop();

    /**
     * @param int $precision The number of decimal points (if any) of the call
     *
     * @return float
     */
    public function duration($precision = 0);
}
