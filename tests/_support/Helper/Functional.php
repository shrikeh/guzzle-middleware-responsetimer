<?php

namespace Tests\Shrikeh\GuzzleMiddleware\TimerLogger\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Psr11\Container;
use Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger;

/**
 * Class Functional.
 */
class Functional extends \Codeception\Module
{
    /**
     * @var \SplFileObject
     */
    private $logFile;

    /**
     * @var \Psr\Container\ContainerInterface
     */
    private $container;

    /**
     * @param array $settings
     */
    public function _beforeSuite($settings = [])
    {
        $logPath = getenv('TEST_OUTPUT_LOG_PATH');

        if (!is_dir(dirname($logPath))) {
            mkdir(dirname($logPath));
        }

        $this->logFile = new \SplFileObject(
            $logPath,
            'w+'
        );

        $pimple = new \Pimple\Container();

        $pimple->register(
            TimerLogger::fromLogger(
                $this->createLogger()
            )
        );

        $this->container = new Container($pimple);
    }

    public function logFile()
    {
        return $this->logFile;
    }

    public function container()
    {
        return $this->container;
    }

    /**
     * @return \Monolog\Logger
     */
    private function createLogger()
    {
        // create a log channel
        $log = new Logger('guzzle');
        $log->pushHandler(
            new StreamHandler(
                $this->logFile()->getRealPath(),
                Logger::DEBUG
            )
        );

        return $log;
    }
}
