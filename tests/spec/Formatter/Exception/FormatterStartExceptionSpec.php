<?php

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception;

use PhpSpec\ObjectBehavior;
use RuntimeException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStartException;

class FormatterStartExceptionSpec extends ObjectBehavior
{
    function it_is_a_runtime_exception()
    {
        $this->shouldHaveType(RuntimeException::class);
    }

    function it_has_the_correct_data_when_constructed_from_msg()
    {
        $e = new \Exception('Some problem');
        $this->beConstructedThroughMsg($e);
        $this->getMessage()->shouldReturn(FormatterStartException::MSG_MESSAGE);
        $this->getCode()->shouldReturn(FormatterStartException::MSG_CODE);
        $this->getPrevious()->shouldReturn($e);
    }

    function it_has_the_correct_data_when_constructed_from_level()
    {
        $e = new \Exception('Some other problem');
        $this->beConstructedThroughLevel($e);
        $this->getMessage()->shouldReturn(FormatterStartException::LEVEL_MESSAGE);
        $this->getCode()->shouldReturn(FormatterStartException::LEVEL_CODE);
        $this->getPrevious()->shouldReturn($e);
    }
}
