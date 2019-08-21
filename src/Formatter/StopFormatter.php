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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Formatter;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LogLevel;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStopException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message\DefaultStopMessage;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Traits\FormatterConstructorTrait;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Traits\FormatterTrait;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class StopFormatter.
 */
final class StopFormatter implements RequestStopInterface
{
    use FormatterTrait;
    use FormatterConstructorTrait;

    /**
     * @param callable|null $msg      A callable used to create the message
     * @param string        $logLevel The level this should be logged at
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\StopFormatter
     */
    public static function create(
        callable $msg = null,
        $logLevel = LogLevel::DEBUG
    ) {
        if (!$msg) {
            $msg = new DefaultStopMessage();
        }

        return new static($msg, $logLevel);
    }

    /**
     * {@inheritdoc}
     */
    public function stop(
        TimerInterface $timer,
        RequestInterface $request,
        $response
    ) {
        try {
            return $this->msg($timer, $request, $response);
        } catch (Exception $ex) {
            throw FormatterStopException::msg($ex);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function levelStop(
        TimerInterface $timer,
        RequestInterface $request,
        $response
    ) {
        try {
            return $this->level($timer, $request, $response);
        } catch (Exception $ex) {
            throw FormatterStopException::level($ex);
        }
    }
}
