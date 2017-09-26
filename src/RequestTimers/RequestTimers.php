<?php
/**
 * @codingStandardsIgnoreStart
 *
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 * @codingStandardsIgnoreEnd
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers;

use Psr\Http\Message\RequestInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\Stopwatch;
use SplObjectStorage;

/**
 * Class TimerHandler.
 */
class RequestTimers implements RequestTimersInterface
{
    /**
     * @var \SplObjectStorage
     */
    private $requestTimers;

    /**
     * TimerHandler constructor.
     */
    public function __construct()
    {
        $this->requestTimers = new SplObjectStorage();
    }

    /**
     * {@inheritdoc}
     */
    public function start(RequestInterface $request)
    {
        if (!$this->requestTimers->contains($request)) {
            $this->requestTimers->attach(
                $request,
                Stopwatch::startStopWatch()
            );
        }
        $timer = $this->timerFor($request);
        $timer->start();

        return $timer;
    }

    /**
     * {@inheritdoc}
     */
    public function stop(RequestInterface $request)
    {
        $timer = $this->timerFor($request);
        $timer->stop();

        return $timer;
    }

    /**
     * {@inheritdoc}
     */
    public function duration(RequestInterface $request)
    {
        return $this->timerFor($request)->duration();
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request The request to retrieve a timer for
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface
     */
    public function timerFor(RequestInterface $request)
    {
        return $this->requestTimers->offsetGet($request);
    }
}
