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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler;

use Exception;

/**
 * Interface ExceptionHandlerInterface.
 */
interface ExceptionHandlerInterface
{
    /**
     * @param \Exception $e An exception to handle
     *
     * @return mixed
     */
    public function handle(Exception $e);
}
