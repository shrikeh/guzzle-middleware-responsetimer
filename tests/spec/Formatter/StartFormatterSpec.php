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
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStartException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

class StartFormatterSpec extends ObjectBehavior
{
    public function it_throws_a_formatter_start_exception_if_the_message_throws_an_exception(
        TimerInterface $timer,
        RequestInterface $request
    ) {
        $oops = new \RuntimeException('Oops');

        $callable = function () use ($oops) {
            throw $oops;
        };

        $this->beConstructedThroughCreate($callable);

        $this->shouldThrow(FormatterStartException::class)
            ->duringStart($timer, $request);
    }

    public function it_throws_a_formatter_start_exception_if_the_level_throws_an_exception(
        TimerInterface $timer,
        RequestInterface $request
    ) {
        $oops = new \RuntimeException('Oops');

        $callable = function () use ($oops) {
            throw $oops;
        };

        $this->beConstructedThroughCreate($callable, $callable);

        $this->shouldThrow(FormatterStartException::class)
            ->duringLevelStart($timer, $request);
    }
}
