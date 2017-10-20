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
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler\TriggerErrorHandler;

class TriggerErrorHandlerSpec extends ObjectBehavior
{
    function it_is_an_exception_handler()
    {
        $this->shouldHaveType(ExceptionHandlerInterface::class);
    }

    function it_turns_exceptions_into_errors()
    {
        $msg = 'Ruh roh';
        $e = new \Exception($msg);
        $this->shouldTrigger(
            TriggerErrorHandler::DEFAULT_ERROR_LEVEL,
            $msg
        )->duringHandle($e);
    }

    function it_throws_the_level_of_error_set()
    {
        $msg = 'Ruh roh';
        $e = new \Exception($msg);

        $this->beConstructedWith(E_USER_NOTICE);

        $this->shouldTrigger(
            E_USER_NOTICE,
            $msg
        )->duringHandle($e);
    }
}
