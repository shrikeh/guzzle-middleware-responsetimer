<?php
/**
 * @codingStandardsIgnoreStart
 *
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 *
 * @codingStandardsIgnoreEnd
 */

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger;

use GuzzleHttp\Psr7\Request;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\Exception\RequestNotFoundException;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimersInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\Exception\ResponseLogStartException;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\Exception\ResponseLoggerException;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\Exception\TimersException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

class ResponseTimeLoggerSpec extends ObjectBehavior
{
    public function let(RequestTimersInterface $timers, ResponseLoggerInterface $logger)
    {
        $this->beConstructedWith($timers, $logger);
    }

    public function it_tells_the_logger_to_start(
        RequestInterface $request,
        TimerInterface $timer,
        $timers,
        $logger
    ) {
        $timers->start($request)->willReturn($timer);
        $logger->logStart($timer, $request)->shouldBeCalled();

        $this->start($request);
    }

    public function it_tells_the_logger_to_stop(
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

    public function it_throws_a_response_logger_exception_if_the_logger_throws_an_exception(
        RequestInterface $request,
        TimerInterface $timer,
        $timers,
        $logger
    ) {
        $timers->start($request)->willReturn($timer);
        $logger->logStart($timer)->willThrow(new ResponseLogStartException('foo'));
        $this->shouldThrow(ResponseLoggerException::class)->duringStart($request);
    }

    public function it_throws_a_timer_exception_if_the_timers_throws_an_exception(
        ResponseInterface $response,
        $timers
    ) {
        $request = new Request('GET', 'https://google.co.uk/');
        $timers->stop($request)->willThrow(new RequestNotFoundException($request));
        $this->shouldThrow(TimersException::class)->duringStop(
            $request,
            $response
        );
    }
}
