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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Traits;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Trait FormatterTrait.
 */
trait FormatterTrait
{
    /**
     * @var string|callable
     */
    private $msg;

    /**
     * @var string|callable
     */
    private $level;

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer    A Timer to format
     * @param \Psr\Http\Message\RequestInterface                         $request  A Request to format
     * @param \Psr\Http\Message\ResponseInterface|null                   $response The Response to format
     *
     * @return string
     */
    private function msg(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response = null
    ) {
        $msg = $this->msg;

        return (string) $msg($timer, $request, $response);
    }

    /**
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface $timer    A Timer to format
     * @param \Psr\Http\Message\RequestInterface                         $request  A Request to format
     * @param \Psr\Http\Message\ResponseInterface|null                   $response The Response to format
     *
     * @return string
     */
    private function level(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response = null
    ) {
        $level = $this->level;

        if (is_callable($level)) {
            $level = $level($timer, $request, $response);
        }

        return (string) $level;
    }
}
