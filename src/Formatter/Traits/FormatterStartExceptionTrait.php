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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Traits;

use Exception;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStartException;

/**
 * Trait FormatterStartExceptionTrait.
 */
trait FormatterStartExceptionTrait
{
    /**
     * @param Exception $e    The previous exception
     * @param string    $msg  A message to put in the exception
     * @param int       $code The error code
     *
     * @return FormatterStartException
     */
    private function startException(
        Exception $e,
        $msg,
        $code
    ) {
        if (!$e instanceof FormatterStartException) {
            $e = new FormatterStartException($msg, $code, $e);
        }

        return $e;
    }
}
