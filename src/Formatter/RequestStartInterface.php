<?php

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
     * @return integer
     */
    public function levelStart();
}
