<?php
/**
 * @codingStandardsIgnoreStart
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 *
 * @codingStandardsIgnoreEnd
 */
namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Handler;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface;

class StartTimerSpec extends ObjectBehavior
{
    function let(ResponseTimeLoggerInterface $responseTimeLogger)
    {
        $this->beConstructedWith($responseTimeLogger);
    }

    function it_notifies_the_response_time_logger_to_start(
        RequestInterface $request,
        $responseTimeLogger
    ) {
        $responseTimeLogger->start($request)->shouldBeCalled();
        $this->__invoke($request);
    }
}
