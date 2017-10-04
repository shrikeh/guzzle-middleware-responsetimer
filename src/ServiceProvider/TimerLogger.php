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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider;

use Pimple\Container;
use Pimple\Psr11\ServiceLocator;
use Pimple\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message\DefaultStartMessage;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Message\DefaultStopMessage;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\StartFormatter;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\StopFormatter;
use Shrikeh\GuzzleMiddleware\TimerLogger\Formatter\Verbose;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler\TriggerErrorHandler;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\StartTimer;
use Shrikeh\GuzzleMiddleware\TimerLogger\Handler\StopTimer;
use Shrikeh\GuzzleMiddleware\TimerLogger\Middleware;
use Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers\RequestTimers;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseLogger\ResponseLogger;
use Shrikeh\GuzzleMiddleware\TimerLogger\ResponseTimeLogger\ResponseTimeLogger;

/**
 * Class TimerLogger.
 */
final class TimerLogger implements ServiceProviderInterface, TimerLoggerInterface
{
    /**
     * @var callable
     */
    private $logger;

    /**
     * @param callable $logger A callable that unwraps to a PSR-3 LoggerInterface
     *
     * @return ServiceLocator
     */
    public static function serviceLocator(callable $logger)
    {
        $pimple = new Container();
        $pimple->register(new self($logger));

        return new ServiceLocator(
            $pimple,
            [self::MIDDLEWARE]
        );
    }

    /**
     * @param ContainerInterface $container A PSR-11 Container to use to build the Logger
     * @param string             $loggerKey The key to use in the PSR-11 container to provide the logger
     *
     * @return TimerLogger
     */
    public static function fromContainer(
        ContainerInterface $container,
        $loggerKey
    ) {
        $logger = function () use ($container, $loggerKey) {
            return $container->get($loggerKey);
        };

        return new self($logger);
    }

    /**
     * @param LoggerInterface $logger A PSR-3 LoggerInterface to log the response times
     *
     * @return TimerLogger
     */
    public static function fromLogger(LoggerInterface $logger)
    {
        $callable = function () use ($logger) {
            return $logger;
        };

        return new self($callable);
    }

    /**
     * @param callable $loggerCallable A callable that unwraps to a PSR-3 LoggerInterface
     *
     * @return TimerLogger
     */
    public static function fromCallable(callable $loggerCallable)
    {
        return new self($loggerCallable);
    }

    /**
     * TimerLogger constructor.
     *
     * @param callable $logger A callable that unwraps to a PSR-3 Logger
     */
    private function __construct(callable $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $this->logger($pimple);
        $this->exceptionHandler($pimple);
        $this->formatter($pimple);
        $this->middlewareHandler($pimple);
        $this->responseTimer($pimple);
    }

    /**
     * @param \Pimple\Container $pimple A Pimple Container to register middleware with
     */
    private function responseTimer(Container $pimple)
    {
        $pimple[self::TIMERS] = function () {
            return new RequestTimers();
        };

        $pimple[self::RESPONSE_LOGGER] = function (Container $con) {
            return new ResponseLogger(
                $con[self::LOGGER],
                $con[self::FORMATTER]
            );
        };

        $pimple[self::RESPONSE_TIME_LOGGER] = function (Container $con) {
            return new ResponseTimeLogger(
                $con[self::TIMERS],
                $con[self::RESPONSE_LOGGER]
            );
        };
    }

    /**
     * @param Container $pimple A Pimple Container
     */
    private function logger(Container $pimple)
    {
        $pimple[self::LOGGER] = $this->logger;
    }

    /**
     * @param \Pimple\Container $pimple A Pimple Container to register middleware with
     */
    private function exceptionHandler(Container $pimple)
    {
        $pimple[self::EXCEPTION_HANDLER] = function () {
            return new TriggerErrorHandler();
        };

        $pimple[self::EXCEPTION_HANDLER_START] = function (Container $con) {
            return $con[self::EXCEPTION_HANDLER];
        };

        $pimple[self::EXCEPTION_HANDLER_STOP] = function (Container $con) {
            return $con[self::EXCEPTION_HANDLER];
        };
    }

    /**
     * @param \Pimple\Container $pimple A Pimple Container to register middleware with
     */
    private function formatter(Container $pimple)
    {
        $pimple[self::FORMATTER_DEFAULT_LOG_LEVEL] = function () {
            return LogLevel::DEBUG;
        };

        $pimple[self::FORMATTER_STOP_LOG_LEVEL] = function () {
            return LogLevel::DEBUG;
        };

        $pimple[self::FORMATTER_START_LOG_LEVEL] = function () {
            return LogLevel::DEBUG;
        };

        $pimple[self::FORMATTER_START_MSG] = function () {
            return new DefaultStartMessage();
        };

        $pimple[self::FORMATTER_STOP_MSG] = function () {
            return new DefaultStopMessage();
        };

        $pimple[self::FORMATTER_START] = function (Container $con) {
            return StartFormatter::create(
                $con[self::FORMATTER_START_MSG],
                $con[self::FORMATTER_START_LOG_LEVEL]
            );
        };

        $pimple[self::FORMATTER_STOP] = function (Container $con) {
            return StopFormatter::create(
                $con[self::FORMATTER_STOP_MSG],
                $con[self::FORMATTER_STOP_LOG_LEVEL]
            );
        };

        $pimple[self::FORMATTER] = function (Container $con) {
            return new Verbose(
                $con[self::FORMATTER_START],
                $con[self::FORMATTER_STOP]
            );
        };
    }

    /**
     * @param \Pimple\Container $pimple A Pimple Container to register middleware with
     */
    private function middlewareHandler(Container $pimple)
    {
        $pimple[self::START_HANDLER] = function (Container $con) {
            return new StartTimer(
                $con[self::RESPONSE_TIME_LOGGER],
                $con[self::EXCEPTION_HANDLER_STOP]
            );
        };

        $pimple[self::STOP_HANDLER] = function (Container $con) {
            return new StopTimer(
                $con[self::RESPONSE_TIME_LOGGER],
                $con[self::EXCEPTION_HANDLER_START]
            );
        };

        $pimple[self::MIDDLEWARE] = function (Container $con) {
            return new Middleware(
                $con[self::START_HANDLER],
                $con[self::STOP_HANDLER]
            );
        };
    }
}
