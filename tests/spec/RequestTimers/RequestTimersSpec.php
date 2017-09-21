<?php

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

class RequestTimersSpec extends ObjectBehavior
{
    public function getMatchers()
    {
        return [
            'beAValidDuration' => function($number) {
                return is_float($number) && $number > 0;
            }
        ];
    }

    function it_returns_the_timer_for_a_request(RequestInterface $request)
    {
        $this->start($request)->shouldBeAnInstanceOf(TimerInterface::class);
    }

    function it_returns_the_same_timer_for_a_request(RequestInterface $request) {
        $start = $this->start($request);

        $this->stop($request)->shouldReturn($start);
    }

    function it_returns_the_duration_for_a_request(RequestInterface $request)
    {
        $this->start($request);
        usleep(1000);
        $this->duration($request)->shouldBeAValidDuration();
    }
}
