<?php

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
