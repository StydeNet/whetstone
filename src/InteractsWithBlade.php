<?php

namespace Styde\Whetstone;

use Illuminate\Testing\TestView;
use Illuminate\View\View;

trait InteractsWithBlade
{
    public function assertTemplateRenders($expectedHtml, $actualTemplate)
    {
        $this->template($actualTemplate)
            ->build()
            ->assertRender($expectedHtml);
    }

    public function template($actualTemplate): TestTemplateBuilder
    {
        return $this->app->make(TestTemplateBuilder::class)->setContent($actualTemplate);
    }

    protected function component(string $componentClass, array $data = []): TestTemplate
    {
        $component = $this->app->make($componentClass, $data);

        $view = $component->resolveView();

        if (! $view instanceof View) {
            $view = view($view);
        }

        return new TestTemplate(
            $view->with($component->data()),
            $this->app->make(TestTemplateFactory::class)->indenter
        );
    }
}
