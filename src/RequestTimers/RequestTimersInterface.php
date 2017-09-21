<?php
namespace Shrikeh\GuzzleMiddleware\TimerLogger\RequestTimers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface RequestTimersInterface
{
    public function start(RequestInterface $request);

    public function stop(RequestInterface $request);
}
