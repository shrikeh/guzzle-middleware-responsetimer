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

abstract class FormatterExceptionAbstract extends RuntimeException
{
    /**
     * @param \Exception|null $e An optional previous Exception
     *
     * @return static
     */
    public static function msg(
        \Exception $e = null
    ) {
        return new static(
            static::MSG_MESSAGE,
            static::MSG_CODE,
            $e
        );
    }

    /**
     * @param \Exception|null $e An optional previous Exception
     *
     * @return static
     */
    public static function level(
        \Exception $e = null
    ) {
        return new static(
            static::LEVEL_MESSAGE,
            static::LEVEL_CODE,
            $e
        );
    }
}
