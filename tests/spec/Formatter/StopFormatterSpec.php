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

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStopException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

final class StopFormatterSpec extends ObjectBehavior
{
    public function it_throws_a_formatter_stop_exception_if_the_message_throws_an_exception(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $oops = new \RuntimeException('Oops');

        $callable = function () use ($oops) {
            throw $oops;
        };

        $this->beConstructedThroughCreate($callable);

        $this->shouldThrow(FormatterStopException::class)
            ->duringStop($timer, $request, $response);
    }

    public function it_throws_a_formatter_stop_exception_if_the_level_throws_an_exception(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $oops = new \RuntimeException('Oops');

        $callable = function () use ($oops) {
            throw $oops;
        };

        $this->beConstructedThroughCreate($callable, $callable);

        $this->shouldThrow(FormatterStopException::class)
            ->duringLevelStop($timer, $request, $response);
    }

    public function it_returns_a_stop_level_using_the_level(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $level = LogLevel::EMERGENCY;

        $callable = function(
            TimerInterface $timer,
            RequestInterface $request,
            ResponseInterface $response
        ) use ($level) {
            return $level;
        };

        $this->beConstructedThroughCreate($callable, $callable);
        $this->levelStop($timer, $request, $response)->shouldReturn($level);
    }

    public function it_returns_a_stop_message_using_the_message(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $msg = 'foo';

        $callable = function(
            TimerInterface $timer,
            RequestInterface $request,
            ResponseInterface $response
        ) use ($msg) {
            return $msg;
        };

        $this->beConstructedThroughCreate($callable, $callable);
        $this->stop($timer, $request, $response)->shouldReturn($msg);
    }
}
