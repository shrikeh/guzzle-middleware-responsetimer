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
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Traits\FormatterConstructorTrait;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Traits\FormatterTrait;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class StartFormatter.
 */
class StartFormatter implements RequestStartInterface
{
    use FormatterTrait;
    use FormatterConstructorTrait;

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
     * {@inheritdoc}
     */
    public function start(TimerInterface $timer, RequestInterface $request)
    {
        try {
            return $this->msg($timer, $request);
        } catch (Exception $e) {
            throw new FormatterStartException(
                FormatterStartException::MESSAGE_START_MSG,
                FormatterStartException::MESSAGE_PARSE_CODE,
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
