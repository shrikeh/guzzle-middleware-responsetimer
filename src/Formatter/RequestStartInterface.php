<?php
/**
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

interface RequestStartInterface
{
    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     *
     * @return string
     */
    public function start(TimerInterface $timer, RequestInterface $request);

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer
     * @param \Psr\Http\Message\RequestInterface                         $request
     *
     * @return int
     */
    public function levelStart(TimerInterface $timer, RequestInterface $request);
}
