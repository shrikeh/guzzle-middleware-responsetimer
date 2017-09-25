<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class StopFormatter
 */
class StopFormatter implements RequestStopInterface
{
    /**
     * @var callable
     */
    private $msg;

    /**
     * @var string|callable
     */
    private $level;

    /**
     * StartFormatter constructor.
     *
     * @param $msg
     * @param $level
     */
    public function __construct(callable $msg, $level = LogLevel::DEBUG)
    {
        $this->msg   = $msg;
        $this->level = $level;
    }


    /**
     * {@inheritdoc}
     */
    public function stop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $msg = $this->msg;

        return $msg($timer, $request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function levelStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $level = $this->level;

        if (is_callable($level)) {
            $level = $level($timer, $request, $response);
        }

        return $level;
    }
}