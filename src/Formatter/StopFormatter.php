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
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStopException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message\DefaultStopMessage;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class StopFormatter.
 */
class StopFormatter implements RequestStopInterface
{
    use FormatterTrait;

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

        return new self($msg, $logLevel);
    }

    /**
     * StartFormatter constructor.
     *
     * @param callable        $msg   A callable to format the messages
     * @param callable|string $level The log level for when the timer ends
     */
    public function __construct(callable $msg, $level = LogLevel::DEBUG)
    {
        $this->msg = $msg;
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
        try {
            return $this->msg($timer, $request, $response);
        } catch (Exception $e) {
            $msg = 'Error attempting to parse for log';
            throw new FormatterStopException(
                $msg,
                FormatterStopException::MESSAGE_PARSE_EXCEPTION,
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function levelStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        return $this->level($timer, $request, $response);
    }
}
