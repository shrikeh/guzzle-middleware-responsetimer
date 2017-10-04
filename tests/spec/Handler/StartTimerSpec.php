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

namespace spec\Shrikeh\GuzzleMiddleware\TimerLogger\Handler;

use PhpSpec\ObjectBehavior;
use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler\ExceptionHandlerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLoggerInterface;

class StartTimerSpec extends ObjectBehavior
{
    public function let(
        ResponseTimeLoggerInterface $responseTimeLogger,
        ExceptionHandlerInterface $exceptionHandler
    ) {
        $this->beConstructedWith(
            $responseTimeLogger,
            $exceptionHandler
        );
    }

    public function it_notifies_the_response_time_logger_to_start(
        RequestInterface $request,
        ResponseTimeLoggerInterface $responseTimeLogger
    ) {
        $responseTimeLogger->start($request)->shouldBeCalled();
        $this->__invoke($request);
    }

    public function it_uses_an_exception_handler(
        RequestInterface $request,
        ResponseTimeLoggerInterface $responseTimeLogger,
        ExceptionHandlerInterface $exceptionHandler
    ) {
        $oops = new \RuntimeException('Nope');
        $responseTimeLogger->start($request)->willThrow($oops);
        $exceptionHandler->handle($oops)->shouldBeCalled();

        $this->__invoke($request);
    }
}
