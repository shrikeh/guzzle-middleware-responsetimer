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

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler;

use PhpSpec\ObjectBehavior;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler\ExceptionHandlerInterface;

class NullExceptionHandlerSpec extends ObjectBehavior
{
    function it_is_an_exception_handler()
    {
        $this->shouldHaveType(ExceptionHandlerInterface::class);
    }
}
