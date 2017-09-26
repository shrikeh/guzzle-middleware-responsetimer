<?php
/**
 * @codingStandardsIgnoreStart
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 * @codingStandardsIgnoreEnd
 */
namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimersInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

class ResponseTimeLoggerSpec extends ObjectBehavior
{
    function let(RequestTimersInterface $timers, ResponseLoggerInterface $logger)
    {
        $this->beConstructedWith($timers, $logger);
    }

    function it_tells_the_logger_to_start(
        RequestInterface $request,
        TimerInterface $timer,
        $timers,
        $logger
    ) {
        $timers->start($request)->willReturn($timer);
        $logger->logStart($timer, $request)->shouldBeCalled();

        $this->start($request);
    }

    function it_tells_the_logger_to_stop(
        RequestInterface $request,
        ResponseInterface $response,
        TimerInterface $timer,
        $timers,
        $logger
    ) {
        $timers->stop($request)->willReturn($timer);
        $logger->logStop($timer, $request, $response)->shouldBeCalled();

        $this->stop($request, $response);
    }
}
