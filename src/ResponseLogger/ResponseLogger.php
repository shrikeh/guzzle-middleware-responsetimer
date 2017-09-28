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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\FormatterInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Timer\TimerInterface;

/**
 * Class ResponseLogger.
 */
class ResponseLogger implements ResponseLoggerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * ResponseLogger constructor.
     *
     * @param LoggerInterface    $logger    The PSR-3 logger
     * @param FormatterInterface $formatter A formatter
     */
    public function __construct(
        LoggerInterface $logger,
        FormatterInterface $formatter
    ) {
        $this->logger = $logger;
        $this->formatter = $formatter;
    }

    /**
     * {@inheritdoc}
     */
    public function logStart(TimerInterface $timer, RequestInterface $request)
    {
        $this->logger->log(
            $this->formatter->levelStart($timer, $request),
            $this->formatter->start($timer, $request)
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function logStop(
        TimerInterface $timer,
        RequestInterface $request,
        ResponseInterface $response
    ) {
        $this->logger->log(
            $this->formatter->levelStop($timer, $request, $response),
            $this->formatter->stop($timer, $request, $response)
        );

        return $this;
    }
}
