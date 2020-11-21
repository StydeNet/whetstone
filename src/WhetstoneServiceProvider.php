<?php

namespace Styde\Whetstone;

use Gajus\Dindent\Indenter;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\ServiceProvider;

class WhetstoneServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TestTemplateFactory::class, function ($app) {
            return new TestTemplateFactory(
                $app[ViewFactory::class],
                __DIR__.'/views/',
                new Indenter
            );
        });
    }
}
