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
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Exception\FormatterStartException;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message\DefaultStartMessage;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class StartFormatter.
 */
class StartFormatter implements RequestStartInterface
{
    use FormatterTrait;

    /**
     * @param callable|null $msg      A callable used to create the message
     * @param string        $logLevel The level this should be logged at
     *
     * @return \Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\StartFormatter
     */
    public static function create(
        callable $msg = null,
        $logLevel = LogLevel::DEBUG
    ) {
        if (!$msg) {
            $msg = new DefaultStartMessage();
        }

        return new self($msg, $logLevel);
    }

    /**
     * StartFormatter constructor.
     *
     * @param callable        $msg   A callable used to create the message
     * @param callable|string $level The level this should be logged at
     */
    private function __construct(callable $msg, $level = LogLevel::DEBUG)
    {
        $this->msg = $msg;
        $this->level = $level;
    }

    /**
     * {@inheritdoc}
     */
    public function start(TimerInterface $timer, RequestInterface $request)
    {
        try {
            return $this->msg($timer, $request);
        } catch (Exception $e) {
            $msg = 'Error attempting to parse for log';
            throw new FormatterStartException(
                $msg,
                FormatterStartException::MESSAGE_PARSE_EXCEPTION,
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function levelStart(TimerInterface $timer, RequestInterface $request)
    {
        return $this->level($timer, $request);
    }
}
