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
 * Class ResponseLoggerException.
 */
final class ResponseLoggerException extends RuntimeException
{
    const MSG_START = 'There was a problem logging the start of the Request to the ResponseLogger';
    const CODE_START = 256;

    /**
     * @param \Exception $e The previous exception
     *
     * @return ResponseLoggerException
     */
    public static function duringStart(Exception $e)
    {
        return new self(self::MSG_START, self::CODE_START, $e);
    }
}
