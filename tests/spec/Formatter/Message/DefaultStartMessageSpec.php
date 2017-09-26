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

use DateTimeImmutable;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message\DefaultStartMessage;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

class DefaultStartMessageSpec extends ObjectBehavior
{
    function it_returns_a_formatted_string_when_invoked(
        TimerInterface $timer,
        RequestInterface $request
    ) {
        $uri = 'https://shrikeh.net';
        $dateTime = new DateTimeImmutable();
        $request->getUri()->willReturn($uri);
        $timer->start()->willReturn($dateTime);

        $this->__invoke($timer, $request)->shouldContain($uri);
        $this->__invoke($timer, $request)->shouldContain(
            $dateTime->format(DefaultStartMessage::FORMAT)
        );

    }
}
