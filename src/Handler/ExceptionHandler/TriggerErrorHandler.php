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

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler;

use Exception;

/**
 * Class ExceptionHandlerInterface.
 */
class TriggerErrorHandler implements ExceptionHandlerInterface
{
    const DEFAULT_ERROR_LEVEL = E_USER_NOTICE;

    /**
     * @var int
     */
    private $errorLevel;

    /**
     * TriggerErrorHandler constructor.
     *
     * @param int $errorLevel the desired error level of exceptions
     */
    public function __construct($errorLevel = self::DEFAULT_ERROR_LEVEL)
    {
        $this->errorLevel = $errorLevel;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Exception $e)
    {
        trigger_error($e->getMessage(), $this->errorLevel);
    }
}
