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
     * @param string $startLevel The level of logging for start messages
     * @param string $stopLevel  The level of logging for stop messages
     *
     * @return self
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
     * @param callable $start      A callable to use for formatting start messages
     * @param callable $stop       A callable to use for formatting stop messages
     * @param string   $startLevel The level for start messages
     * @param string   $stopLevel  The level for stop messages
     *
     * @return self
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
     * @param RequestStartInterface $start A formatter for when the Request starts
     * @param RequestStopInterface  $stop  A formatter for when the Request ends
     */
    public function __construct(
        RequestStartInterface $start,
        RequestStopInterface $stop
    ) {
        $this->start = $start;
        $this->stop = $stop;
    }

    /**
     * {@inheritdoc}
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
