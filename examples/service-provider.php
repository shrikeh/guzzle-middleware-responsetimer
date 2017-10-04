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

require_once __DIR__.'/../vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger;

$logsPath = __DIR__.'/logs';
if (!is_dir($logsPath)) {
    mkdir($logsPath);
}

$logFile = new SplFileObject($logsPath.'/example.log', 'w+');

// create a log channel
$logger = new Logger('guzzle');
$logger->pushHandler(new StreamHandler(
    $logFile->getRealPath(),
    Logger::DEBUG
));

$pimple = new Pimple\Container();


// Create the middleware directly from an active instance of a LoggerInterface
$pimple->register(TimerLogger::fromLogger($logger));

$callable = function() use ($logFile) {
    $logger = new Logger('guzzle');
    $logger->pushHandler(new StreamHandler(
        $logFile->getRealPath(),
        Logger::DEBUG
    ));

    return $logger;
};

// Alternatively pass a simple callable to the static constructor
$pimple->register(TimerLogger::fromCallable($callable));

$someKeyForALogger = 'some_key_for_a_logger';

$pimple[$someKeyForALogger] = $callable;

$container = new Pimple\Psr11\Container($pimple);

// Or pass it a PSR-11 container and the key that will unwrap the PSR-3 LoggerInterface
$pimple->register(TimerLogger::fromContainer($container, $someKeyForALogger));

// The middleware is good to go.
echo get_class($pimple[TimerLogger::MIDDLEWARE]);
