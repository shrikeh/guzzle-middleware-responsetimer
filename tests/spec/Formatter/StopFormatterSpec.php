<?php

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStopException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

class StopFormatterSpec extends ObjectBehavior
{

    function it_throws_a_formatter_stop_exception(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $oops = new \RuntimeException('Oops');

        $callable = function() use ($oops) {
            throw $oops;
        };

        $this->beConstructedThroughCreate($callable);

        $this->shouldThrow(FormatterStopException::class)
            ->duringStop($timer, $request, $response);
    }
}
