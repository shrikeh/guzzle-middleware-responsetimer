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

use RuntimeException;

/**
 * Class ResponseTimeLoggerException.
 */
final class ResponseTimeLoggerException extends RuntimeException
{
    const TIMER_STOP_MSG = 'An error occurred when attempting to stop the timer';
    const TIMER_STOP_CODE = 32;
}
