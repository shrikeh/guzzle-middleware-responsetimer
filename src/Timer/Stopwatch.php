<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Timer;

use DateTimeImmutable;
use Litipk\BigNumbers\Decimal;
use Psr\Http\Message\RequestInterface;

/**
 * Class Stopwatch
 */
class Stopwatch implements TimerInterface
{
    /**
     * @var \Litipk\BigNumbers\Decimal
     */
    private $start;

    /**
     * @var \Litipk\BigNumbers\Decimal
     */
    private $end;

    /**
     * Stopwatch constructor.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {

        $this->request = $request;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function start()
    {
        $t = \microtime(true);
        if (!$this->start) {
            $this->start = Decimal::fromFloat($t);
        }

        return $this->dateTime($this->start);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function stop()
    {
        $t = \microtime(true);
        if (!$this->end) {
            $this->end = Decimal::fromFloat($t);
            ;
        }

        return $this->dateTime($this->end);
    }

    /**
     * @param int $scale
     *
     * @return float
     */
    public function duration($scale = 0)
    {
        $this->stop();

        return Decimal::fromDecimal($this->end->sub($this->start)
            ->mul(Decimal::fromInteger(1000)), $scale)->asFloat();
    }

    /**
     * @param \Litipk\BigNumbers\Decimal $time
     *
     * @return \DateTimeImmutable
     */
    private function dateTime(Decimal $time)
    {
        $micro = sprintf('%06d', $this->mantissa($time)->asInteger());

        return new DateTimeImmutable(
            \date('Y-m-d H:i:s.'.$micro, $time->asFloat())
        );
    }

    /**
     * @param \Litipk\BigNumbers\Decimal $time
     *
     * @return \Litipk\BigNumbers\Decimal
     */
    private function mantissa(Decimal $time)
    {
        $mantissa = ($time->sub($time->floor()));

        return $mantissa->mul(Decimal::fromInteger(1000000));
    }
}
