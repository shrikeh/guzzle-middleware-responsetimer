<?php

namespace Tests\Shrikeh\GuzzleMiddleware\TimerLogger;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Mcustiel\Phiremock\Client\Phiremock;
use Mcustiel\Phiremock\Client\Utils\A;
use Mcustiel\Phiremock\Client\Utils\Is;
use Mcustiel\Phiremock\Client\Utils\Respond;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger;

/**
 * Inherited Methods.
 *
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
        $uri = '/some/url';

        $this->expectARequestToRemoteServiceWithAResponse(
            Phiremock::on(
                A::getRequest()->andUrl(Is::equalTo($uri))
            )->then(
                Respond::withStatusCode(203)->andBody('I am a response')
            )
        );

        $client = $this->createClient($this->container());

        $client->request('GET', $uri);
    }

    /**
     * @Then the response time duration is logged to the logger
     */
    public function theResponseTimeDurationIsLoggedToTheLogger()
    {
        $logContents = $this->logFile()->fread(
            $this->logFile()->getSize()
        );

        $this->assertContains('guzzle.DEBUG', $logContents);
        $this->assertContains('code 203', $logContents);
    }

    /**
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \GuzzleHttp\Client
     */
    private function createClient(ContainerInterface $container)
    {
        // now create a Guzzle middleware stack
        $stack = HandlerStack::create();

        // and register the middleware on the stack
        $middleware = $container->get(TimerLogger::MIDDLEWARE);

        $stack->push($middleware());

        $config = [
            'timeout' => 0.5,
            'handler' => $stack,
            'base_uri' => 'http://localhost:8086',
        ];

        // then hand the stack to the client
        return new Client($config);
    }
}
