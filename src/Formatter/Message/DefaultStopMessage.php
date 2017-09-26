<?php
/**
 * @codingStandardsIgnoreStart
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 * @codingStandardsIgnoreEnd
 */
namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class DefaultStopMessage.
 */
class DefaultStopMessage
{
    const MSG = 'Completed call to %s in %dms with response code %d';

    /**
     * @param TimerInterface    $timer    The timer to format for the log
     * @param RequestInterface  $request  The Request to format for the log
     * @param ResponseInterface $response The Response to format for the log
     *
     * @return string
     */
    public function __invoke(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        return \sprintf(
            self::MSG,
            $request->getUri(),
            $timer->duration(),
            $response->getStatusCode()
        );
    }
}
