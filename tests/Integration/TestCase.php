<?php

namespace Tests\Integration;

use Styde\Whetstone\WhetstoneServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadViewsFrom(__DIR__ . '/resources/views');
    }

    protected function getPackageProviders($app)
    {
        return [
            WhetstoneServiceProvider::class,
        ];
    }

    private function loadViewsFrom($dir): void
    {
        $this->app['view']->addLocation($dir);
    }
}
