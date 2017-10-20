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
namespace Tests\Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider;

use Pimple\Container;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Shrikeh\GuzzleMiddleware\TimerLogger\Middleware;
use Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger;

/**
 * Class PimpleTest
 */
class PimpleTest extends \Codeception\Test\Unit
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function createMockLogger()
    {
        return $this->createMock(LoggerInterface::class);
    }

    /**
     * @covers \Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger:register
     * @covers \Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger::fromLogger
     *
     * @uses LoggerInterface
     *
     * @group DependencyInjection
     */
    public function testConfiguresPimpleWithMiddlewareFromLogger()
    {
        $pimple = new Container();

        $logger = $this->createMockLogger();

        $pimple->register(TimerLogger::fromLogger($logger));

        $this->assertInstanceOf(Middleware::class, $pimple[TimerLogger::MIDDLEWARE]);
    }

    /**
     * @covers \Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger:register()
     * @covers \Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger::fromContainer()
     *
     * @uses LoggerInterface
     *
     * @group DependencyInjection
     */
    public function testConfiguresPimpleWithMiddlewareFromPsr11Container()
    {
        $key = 'test.logger';
        $logger = $this->createMockLogger();

        $container = $this->createMock(ContainerInterface::class);

        $container->expects($this->once())->method('get')->with($key)
            ->willReturn($logger);

        $pimple = new Container();

        $pimple->register(TimerLogger::fromContainer($container, $key));

        $this->assertInstanceOf(Middleware::class, $pimple[TimerLogger::MIDDLEWARE]);
    }

    /**
     * @covers \Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger:register()
     * @covers \Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider\TimerLogger::serviceLocator()
     *
     * @uses LoggerInterface
     *
     * @group DependencyInjection
     */
    public function testCreatesAServiceLocator()
    {
        $logger = $this->createMockLogger();

        $callable = function() use ($logger) {
            return $logger;
        };

        $serviceLocator = TimerLogger::serviceLocator($callable);

        $this->assertInstanceOf(ContainerInterface::class, $serviceLocator);
        $this->assertTrue($serviceLocator->has(TimerLogger::MIDDLEWARE));
    }
}
