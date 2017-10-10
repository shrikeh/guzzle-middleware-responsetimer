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
}
