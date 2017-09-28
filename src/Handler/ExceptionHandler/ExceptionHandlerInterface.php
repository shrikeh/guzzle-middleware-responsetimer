<?php

namespace Shrikeh\GuzzleMiddleware\TimerLogger\Handler\ExceptionHandler;

use Exception;

interface ExceptionHandlerInterface
{
    public function handle(Exception $e);
}
