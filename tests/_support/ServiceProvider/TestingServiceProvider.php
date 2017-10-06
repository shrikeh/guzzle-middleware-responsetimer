<?php

namespace Tests\Shrikeh\GuzzleMiddleware\TimerLogger\ServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Blackfire\Profile\Configuration;

class TestingServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['blackfire_config'] = function(Container $con) {
            return new Configuration();
        };
    }
}
