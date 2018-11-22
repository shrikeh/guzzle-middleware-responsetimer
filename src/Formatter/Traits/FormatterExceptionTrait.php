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
        return new self(
            self::msgMessage(),
            self::msgCode(),
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
        return new self(
            self::levelMsg(),
            self::levelCode(),
            $e
        );
    }

    /**
     * @return string
     */
    abstract protected static function msgMessage();

    /**
     * @return int
     */
    abstract protected static function msgCode();

    /**
     * @return string
     */
    abstract protected static function levelMsg();

    /**
     * @return int
     */
    abstract protected static function levelCode();
}
