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
class FormatterStartException extends RuntimeException
{
    const MESSAGE_START_MSG  = 'Error attempting to parse start message for log';
    const MESSAGE_PARSE_CODE = 1;

    const LEVEL_START_MSG    = 'Error determining log level for start';
    const LEVEL_START_CODE   = 2;
}
