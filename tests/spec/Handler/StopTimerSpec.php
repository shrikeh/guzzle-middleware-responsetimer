<?php
/**
 * @codingStandardsIgnoreStart
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 * @codingStandardsIgnoreEnd
 */
namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Handler;

use Closure;
use GuzzleHttp\Promise\PromiseInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface;

class StopTimerSpec extends ObjectBehavior
{
    function let(ResponseTimeLoggerInterface $responseTimeLogger)
    {
        $this->beConstructedWith($responseTimeLogger);
    }

    function it_binds_to_the_promise(
        RequestInterface $request,
        PromiseInterface $promise
    ) {
        $promise->then(
            Argument::type(Closure::class),
            Argument::type(Closure::class)
        )->shouldBeCalled();

        $this->__invoke($request, [], $promise);
    }
}
