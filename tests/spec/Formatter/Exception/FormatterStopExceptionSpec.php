<?php

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception;

use PhpSpec\ObjectBehavior;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStopException;

/**
 * Class FormatterStopExceptionSpec
 */
class FormatterStopExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FormatterStopException::class);
    }

    function it_is_a_runtime_exception()
    {
        $this->shouldHaveType(\RuntimeException::class);
    }
}
