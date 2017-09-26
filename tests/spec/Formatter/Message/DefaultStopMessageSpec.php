<?php
/**
 * @codingStandardsIgnoreStart
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 *
 * @codingStandardsIgnoreEnd
 */
namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;
use Teapot\StatusCode;

class DefaultStopMessageSpec extends ObjectBehavior
{
    function it_returns_a_formatted_string_when_invoked(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $uri = 'https://shrikeh.net';
        $duration = 1024;
        $responseCode = StatusCode::CREATED;
        $request->getUri()->willReturn($uri);
        $response->getStatusCode()->willReturn($responseCode);
        $timer->duration()->willReturn($duration);
        $this->__invoke($timer, $request, $response)->shouldContain("$duration");
        $this->__invoke($timer, $request, $response)->shouldContain("$responseCode");
        $this->__invoke($timer, $request, $response)->shouldContain("$uri");
    }
}
