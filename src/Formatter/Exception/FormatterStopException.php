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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception;

use Exception;
use RuntimeException;

/**
 * Class FormatterException.
 */
final class FormatterStopException extends RuntimeException
{
    const MESSAGE_STOP_MSG = 'Error attempting to parse stop message for log';
    const MESSAGE_PARSE_CODE = 1;

    const LEVEL_STOP_MSG = 'Error determining log level for stop';
    const LEVEL_STOP_CODE = 2;

    /**
     * @param \Exception $e The previous exception
     *
     * @return FormatterStopException
     */
    public static function msg(Exception $e)
    {
        return new self(
            self::MESSAGE_STOP_MSG,
            self::MESSAGE_PARSE_CODE,
            $e
        );
    }

    /**
     * @param \Exception $e The previous exception
     *
     * @return FormatterStopException
     */
    public static function level(Exception $e)
    {
        return new self(
            self::LEVEL_STOP_MSG,
            self::LEVEL_STOP_CODE,
            $e
        );
    }
}
