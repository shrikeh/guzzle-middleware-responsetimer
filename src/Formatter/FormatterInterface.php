<?php
/**
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

/**
 * Interface FormatterInterface.
 */
interface FormatterInterface extends RequestStartInterface, RequestStopInterface
{
}
