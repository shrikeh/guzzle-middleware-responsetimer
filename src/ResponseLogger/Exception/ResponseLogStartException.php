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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\Exception;

use Exception;
use RuntimeException;

/**
 * Class ResponseLogStartException.
 */
final class ResponseLogStartException extends RuntimeException
{
    const START_MSG = 'An error occurred while attempting to log the request start';
    const START_CODE = 4;

    /**
     * @param \Exception $e The previous exception
     *
     * @return ResponseLogStartException
     */
    public static function start(Exception $e)
    {
        return new self(
            self::START_MSG,
            self::START_CODE,
            $e
        );
    }
}
