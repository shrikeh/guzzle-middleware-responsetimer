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

/**
 * Trait FormatterStartExceptionTrait.
 */
trait FormatterExceptionTrait
{
    /**
     * @param \Exception|null $e An optional previous Exception
     *
     * @return static
     */
    public static function msg(
        Exception $e = null
    ) {
        return new static(
            self::MSG_MESSAGE,
            self::MSG_CODE,
            $e
        );
    }

    /**
     * @param \Exception|null $e An optional previous Exception
     *
     * @return static
     */
    public static function level(
        Exception $e = null
    ) {
        return new static(
            self::LEVEL_MESSAGE,
            self::LEVEL_CODE,
            $e
        );
    }
}
