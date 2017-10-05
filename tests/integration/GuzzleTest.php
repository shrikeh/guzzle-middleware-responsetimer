<?php

namespace Tests\Shrikeh\GuzzleMiddleware\TimerLogger;

use Psr\Container\ContainerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger;
use Pimple\Psr11\Container as Psr11Container;
use Pimple\Container as PimpleContainer;

class GuzzleTest extends \Codeception\Test\Unit
{
    const LOGGER = 'tests.codecept.logger';

    use \Blackfire\Bridge\PhpUnit\TestCaseTrait;

    /**
     * @var \Psr\Container\ContainerInterface
     */
    private $container;

    /**
     * @var \Tests\Shrikeh\GuzzleMiddleware\TimerLogger\IntegrationDeveloper
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    protected function _inject(PimpleContainer $pimple)
    {
        $container = new Psr11Container($pimple);
        $pimple->register(TimerLogger::fromContainer(
            $container,
            self::LOGGER
        ));

        $this->container = $container;
    }

    // tests
    public function testBlackfire()
    {

    }
}
