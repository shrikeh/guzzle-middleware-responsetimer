<?php
namespace Shrikeh\GuzzleMiddleware\TimerLogger;

/**
 * Class Middleware
 * @package Shrikeh\GuzzleMiddleware\TimerLogger
 */
class Middleware
{
    /**
     * @var callable
     */
    private $startHandler;

    /**
     * @var callable
     */
    private $stopHandler;

    /**
     * Middleware constructor.
     *
     * @param callable $startHandler
     * @param callable $stopHandler
     */
    public function __construct(callable $startHandler, callable $stopHandler)
    {
        $this->startHandler = $startHandler;
        $this->stopHandler = $stopHandler;
    }


    public function __invoke()
    {
        return $this->tap();
    }

    public function tap()
    {
        return \GuzzleHttp\Middleware::tap($this->startHandler, $this->stopHandler);
    }
}
