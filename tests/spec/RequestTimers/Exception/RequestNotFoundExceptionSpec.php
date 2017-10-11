<?php

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\Exception;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;

class RequestNotFoundExceptionSpec extends ObjectBehavior
{
    function let(RequestInterface $request)
    {
        $this->beConstructedWith($request);
    }

    function it_returns_the_request_it_could_not_find(
        RequestInterface $request
    ) {
        $uri = 'https://google.co.uk/foo';
        $request->getUri()->willReturn($uri);
        $this->getRequest()->shouldReturn($request);
    }

    function it_has_the_uri_of_the_request_in_the_message(
        RequestInterface $request
    ) {
        $uri = 'https://google.co.uk/foo';
        $request->getUri()->willReturn($uri);
        $this->getMessage()->shouldContain($uri);
    }

}

