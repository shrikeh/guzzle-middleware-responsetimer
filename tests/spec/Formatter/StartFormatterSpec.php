<?php

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStartException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

class StartFormatterSpec extends ObjectBehavior
{

    function it_throws_a_formatter_start_exception(
        TimerInterface $timer,
        RequestInterface $request
    ) {
        $oops = new \RuntimeException('Oops');

        $callable = function() use ($oops) {
            throw $oops;
        };

        $this->beConstructedThroughCreate($callable);

        $this->shouldThrow(FormatterStartException::class)
            ->duringStart($timer, $request);
    }
}
