<?php
/**
 * @author       Barney Hanlon <barney@shrikeh.net>
 * @copyright    Barney Hanlon 2017
 * @license      https://opensource.org/licenses/MIT
 */

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message\DefaultStartMessage;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message\DefaultStopMessage;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class Verbose.
 */
class Verbose implements FormatterInterface
{
    /**
     * @var RequestStartInterface
     */
    private $start;

    /**
     * @var RequestStopInterface
     */
    private $stop;

    /**
     * @param string $startLevel
     * @param string $stopLevel
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Verbose
     */
    public static function quickStart(
        $startLevel = LogLevel::DEBUG,
        $stopLevel = LogLevel::DEBUG
    ) {
        return self::fromCallables(
            new DefaultStartMessage(),
            new DefaultStopMessage(),
            $startLevel,
            $stopLevel
        );
    }

    /**
     * @param callable $start
     * @param callable $stop
     * @param string   $startLevel
     * @param string   $stopLevel
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Verbose
     */
    public static function fromCallables(
        callable $start,
        callable $stop,
        $startLevel = LogLevel::DEBUG,
        $stopLevel = LogLevel::DEBUG
    ) {
        return new self(
            new StartFormatter($start, $startLevel),
            new StopFormatter($stop, $stopLevel)
        );
    }

    /**
     * Verbose constructor.
     *
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\RequestStartInterface $start
     * @param \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\RequestStopInterface  $stop
     */
    public function __construct(
        RequestStartInterface $start,
        RequestStopInterface $stop
    ) {
        $this->start = $start;
        $this->stop = $stop;
    }

    /**
     * @return string
     */
    public function levelStart(TimerInterface $timer, RequestInterface $request)
    {
        return $this->start->levelStart($timer, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function start(TimerInterface $timer, RequestInterface $request)
    {
        return $this->start->start($timer, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function levelStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        return $this->stop->levelStop($timer, $request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function stop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        return $this->stop->stop($timer, $request, $response);
    }
}
