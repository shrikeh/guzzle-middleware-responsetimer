<?php
namespace Tests\Shrikeh\GuzzleMiddleware\TimerLogger;
use Pimple\Container;
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
    private $container;

    use _generated\FunctionalDeveloperActions;

    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @Given that I have a logger
     */
    public function thatIHaveALogger()
    {
        $this->container['test_logger'] = function() {

        };
    }

    /**
     * @When I make an outbound HTTP request
     */
    public function iMakeAnOutboundHTTPRequest()
    {
        throw new \Codeception\Exception\Incomplete("Step `I make an outbound HTTP request` is not defined");
    }

    /**
     * @Then the response time duration is logged to the logger
     */
    public function theResponseTimeDurationIsLoggedToTheLogger()
    {
        throw new \Codeception\Exception\Incomplete("Step `the response time duration is logged to the logger` is not defined");
    }
}
