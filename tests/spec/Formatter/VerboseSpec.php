<?php

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\RequestStartInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\RequestStopInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

class VerboseSpec extends ObjectBehavior
{
    function it_returns_a_start_level(
        TimerInterface $timer,
        RequestInterface $request
    ) {
        $this->beConstructedThroughQuickStart(
            LogLevel::INFO
        );
        $this->levelStart($timer, $request)->shouldReturn(LogLevel::INFO);
    }

    function it_returns_a_stop_level(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $this->beConstructedThroughQuickStart(
            LogLevel::INFO,
            LogLevel::ALERT
        );
        $this->levelStop($timer, $request, $response)->shouldReturn(LogLevel::ALERT);
    }

    function it_uses_request_start_message_to_format(
        RequestStartInterface $start,
        RequestStopInterface $stop,
        TimerInterface $timer,
        RequestInterface $request
    ) {
        $startString = 'foo-bar-baz';
        $this->beConstructedWith($start, $stop);

        $start->start($timer, $request)->willReturn($startString);
        $this->start($timer, $request)->shouldReturn($startString);
    }
}
