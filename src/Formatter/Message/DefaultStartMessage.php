<?php
/**
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message;

use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class DefaultStartMessage.
 */
class DefaultStartMessage
{
    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     *
     * @return string
     */
    public function __invoke(
        TimerInterface $timer,
        RequestInterface $request
    ) {
        $msg = 'Started call to %s at %s';

        return \sprintf(
            $msg,
            $request->getUri(),
            $timer->start()->format('Y-m-d H:i:s')
        );
    }
}
