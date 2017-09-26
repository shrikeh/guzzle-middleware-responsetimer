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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message;

use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class DefaultStartMessage.
 */
class DefaultStartMessage
{
    const MSG = 'Started call to %s at %s';
    const FORMAT = 'Y-m-d H:i:s';

    /**
     * @param TimerInterface   $timer   The timer to format
     * @param RequestInterface $request The request for the timer
     *
     * @return string
     */
    public function __invoke(
        TimerInterface $timer,
        RequestInterface $request
    ) {
        return \sprintf(
            self::MSG,
            $request->getUri(),
            $timer->start()->format(self::FORMAT)
        );
    }
}
