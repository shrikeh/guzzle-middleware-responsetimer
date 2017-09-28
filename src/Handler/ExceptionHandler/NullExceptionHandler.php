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
 * Interface ExceptionHandlerInterface
 */
class NullExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(Exception $e)
    {
        // TODO: Implement handle() method.
    }
}
