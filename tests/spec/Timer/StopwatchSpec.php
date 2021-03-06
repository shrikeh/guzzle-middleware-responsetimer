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

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Timer;

use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class StopwatchSpec extends ObjectBehavior
{
    public function getMatchers()
    {
        return [
            'beAValidDuration' => function ($number) {
                return is_float($number) && $number > 0;
            },
        ];
    }

    public function it_has_a_start_time()
    {
        $this->start()->shouldBeAnInstanceOf(DateTimeImmutable::class);
    }

    public function it_has_an_end_time()
    {
        $this->stop()->shouldBeAnInstanceOf(DateTimeImmutable::class);
    }

    public function it_returns_the_duration()
    {
        $this->start();
        usleep(1200);
        $this->duration()->shouldBeAValidDuration();
    }
}
