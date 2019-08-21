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
     * @param TimerInterface                                                $timer    A Timer to format
     * @param RequestInterface                                              $request  A Request to format
     * @param ResponseInterface|null|\GuzzleHttp\Exception\ConnectException $response The Response to format
     *
     * @return string
     */
    private function msg(
        TimerInterface $timer,
        RequestInterface $request,
        $response = null
    ) {
        $msg = $this->getMsg();

        return (string) $msg($timer, $request, $response);
    }

    /**
     * @param TimerInterface                                                $timer    A Timer to format
     * @param RequestInterface                                              $request  A Request to format
     * @param ResponseInterface|null|\GuzzleHttp\Exception\ConnectException $response The Response to format
     *
     * @return string
     */
    private function level(
        TimerInterface $timer,
        RequestInterface $request,
        $response = null
    ) {
        $level = $this->getLevel();

        if (is_callable($level)) {
            $level = $level($timer, $request, $response);
        }

        return (string) $level;
    }

    /**
     * @return callable
     */
    abstract protected function getMsg();

    /**
     * @return string|callable
     */
    abstract protected function getLevel();
}
