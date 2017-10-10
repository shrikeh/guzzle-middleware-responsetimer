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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\Exception;

use Exception;
use RuntimeException;

/**
 * Class TimersException.
 */
final class TimersException extends RuntimeException
{
    const TIMER_START_MSG = 'An error occurred while attempting to start the timer';
    const TIMER_START_CODE = 32;

    const TIMER_STOP_MSG = 'An error occurred while attempting to stop the timer';
    const TIMER_STOP_CODE = 64;

    /**
     * @param \Exception $e The timer exception
     *
     * @return TimersException
     */
    public static function start(Exception $e)
    {
        return new self(
            self::TIMER_STOP_MSG,
            self::TIMER_STOP_CODE,
            $e
        );
    }

    /**
     * @param \Exception $e The timer exception
     *
     * @return TimersException
     */
    public static function stop(Exception $e)
    {
        return new self(
            self::TIMER_STOP_MSG,
            self::TIMER_STOP_CODE,
            $e
        );
    }
}
