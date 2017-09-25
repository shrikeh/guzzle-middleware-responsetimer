<?php
namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class DefaultStopMessage
 */
class DefaultStopMessage
{
    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     * @param \Psr\Http\Message\ResponseInterface                        $response
     *
     * @return string
     */
    public function __invoke(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $msg = 'Completed call to %s in %dms with response code %d';

        return \sprintf(
            $msg,
            $request->getUri(),
            $timer->duration(),
            $response->getStatusCode()
        );
    }
}
