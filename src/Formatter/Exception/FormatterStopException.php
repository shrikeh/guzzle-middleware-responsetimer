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

use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Traits\FormatterExceptionTrait;

/**
 * Class FormatterException.
 */
final class FormatterStopException extends FormatterExceptionAbstract
{
    use FormatterExceptionTrait;

    const MSG_MESSAGE = 'Error attempting to parse stop message for log';
    const MSG_CODE = 1;

    const LEVEL_MESSAGE = 'Error determining log level for stop';
    const LEVEL_CODE = 2;
}
