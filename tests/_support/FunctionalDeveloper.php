<?php
namespace Tests\Shrikeh\GuzzleMiddleware\TimerLogger;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Psr11\Container;
use Psr\Container\ContainerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class FunctionalDeveloper extends \Codeception\Actor
{

    use _generated\FunctionalDeveloperActions;

    private function createLogger()
    {
        $logsPath = __DIR__.'/logs';
        if (!is_dir($logsPath)) {
            mkdir($logsPath);
        }

        $logFile = new \SplFileObject($logsPath.'/example.log', 'w+');

        // create a log channel
        $log = new Logger('guzzle');
        $log->pushHandler(
            new StreamHandler(
                $logFile->getRealPath(),
                Logger::DEBUG
            )
        );

        return $log;
    }

    private function createClient(ContainerInterface $container)
    {
        // now create a Guzzle middleware stack
        $stack = HandlerStack::create();

        // and register the middleware on the stack
        $middleware = $container->get(TimerLogger::MIDDLEWARE);

        $stack->push($middleware());

        $config = [
            'timeout'   => 2,
            'handler' => $stack,
        ];

        // then hand the stack to the client
        return new Client($config);
    }

    /**
     * @Given that I have an external service
     */
    public function thatIHaveAnExternalService()
    {
        $this->haveACleanSetupInRemoteService();
    }

    /**
     * @When I make an outbound HTTP request to it
     */
    public function iMakeAnOutboundHTTPRequest()
    {
        $pimple = new \Pimple\Container();

        $pimple->register(
            TimerLogger::fromLogger(
                $this->createLogger()
            )
        );

        $client = $this->createClient(new Container($pimple));

        $client->getAsync()
    }

    /**
     * @Then the response time duration is logged to the logger
     */
    public function theResponseTimeDurationIsLoggedToTheLogger()
    {
        throw new \Codeception\Exception\Incomplete("Step `the response time duration is logged to the logger` is not defined");
    }
}
