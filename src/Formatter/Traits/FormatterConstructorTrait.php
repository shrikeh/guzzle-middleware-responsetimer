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

use Psr\Log\LogLevel;

/**
 * Trait FormatterConstructorTrait
 */
trait FormatterConstructorTrait
{
    /**
     * @var string|callable
     */
    private $msg;

    /**
     * @var string|callable
     */
    private $level;

    /**
     * StartFormatter constructor.
     *
     * @param callable        $msg   A callable used to create the message
     * @param callable|string $level The level this should be logged at
     */
    private function __construct(callable $msg, $level = LogLevel::DEBUG)
    {
        $this->msg = $msg;
        $this->level = $level;
    }


    /**
     * @return callable|string
     */
    protected function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return callable|string
     */
    protected function getLevel()
    {
        return $this->level;
    }
}
