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

use RuntimeException;

/**
 * Class ResponseLogStartException.
 */
final class ResponseLogStopException extends RuntimeException
{
    const STOP_MSG = 'An error occurred while attempting to log the request end';
    const STOP_CODE = 8;
}
