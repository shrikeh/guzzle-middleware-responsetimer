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

/**
 * Interface TimerLoggerInterface.
 */
interface TimerLoggerInterface
{
    const MIDDLEWARE = 'guzzle.middleware.timerlogger';

    const TIMERS = 'guzzle.middleware.timerlogger.timers';
    const LOGGER = 'guzzle.middleware.timerlogger.logger';
    const RESPONSE_LOGGER = 'guzzle.middleware.timerlogger.response_logger';

    const FORMATTER = 'guzzle.middleware.timerlogger.formatter';
    const FORMATTER_DEFAULT_LOG_LEVEL = 'guzzle.middleware.timerlogger.formatter.log_level';

    const FORMATTER_START = 'guzzle.middleware.timerlogger.formatter.start';
    const FORMATTER_START_MSG = 'guzzle.middleware.timerlogger.formatter.start.msg';
    const FORMATTER_START_LOG_LEVEL = 'guzzle.middleware.timerlogger.formatter.start.log_level';

    const FORMATTER_STOP = 'guzzle.middleware.timerlogger.formatter.stop';
    const FORMATTER_STOP_MSG = 'guzzle.middleware.timerlogger.formatter.stop.msg';
    const FORMATTER_STOP_LOG_LEVEL = 'guzzle.middleware.timerlogger.formatter.stop.log_level';

    const START_HANDLER = 'guzzle.middleware.timerlogger.start_handler';
    const STOP_HANDLER = 'guzzle.middleware.timerlogger.stop_handler';
    const RESPONSE_TIME_LOGGER = 'guzzle.middleware.timerlogger.response_time_logger';
    const EXCEPTION_HANDLER = 'guzzle.middleware.timerlogger.exception_handler';
    const EXCEPTION_HANDLER_START = 'guzzle.middleware.timerlogger.start_handler.exception_handler';
    const EXCEPTION_HANDLER_STOP = 'guzzle.middleware.timerlogger.stop_handler.exception_handler';
}
