<?php
/**
 * @codingStandardsIgnoreStart
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 * @codingStandardsIgnoreEnd
 */
namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Interface RequestStartInterface.
 */
interface RequestStartInterface
{
    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer   A Timer to format
     * @param \Psr\Http\Message\RequestInterface                         $request A Request to format
     *
     * @return string
     */
    public function start(TimerInterface $timer, RequestInterface $request);

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer   A Timer to format
     * @param \Psr\Http\Message\RequestInterface                         $request A Request to format
     *
     * @return string
     */
    public function levelStart(TimerInterface $timer, RequestInterface $request);
}
