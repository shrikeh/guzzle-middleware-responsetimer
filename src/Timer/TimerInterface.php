<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Timer;

/**
 * Interface TimerInterface
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
     * @param int $precision
     *
     * @return float
     */
    public function duration($precision = 0);
}
