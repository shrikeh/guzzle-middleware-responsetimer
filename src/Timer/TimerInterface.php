<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Timer;

/**
 * Interface TimerInterface
 * @package Shrikeh\GuzzleMiddleware\TimerLogger\Timer
 */
interface TimerInterface
{
    /**
     * @return \DateTimeImmutable
     */
    public function start();

    /**
     * @return \DateTimeImmutable
     */
    public function stop();

    /**
     * @return float
     */
    public function duration();
}
