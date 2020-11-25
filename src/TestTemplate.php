<?php

namespace Styde\Whetstone;

use Gajus\Dindent\Indenter;
use Illuminate\Testing\TestView;
use Illuminate\View\View;
use PHPUnit\Framework\Assert as PHPUnit;

class TestTemplate extends TestView
{
    /**
     * @var Indenter
     */
    private $indenter;

    public function __construct(View $view, Indenter $indenter)
    {
        parent::__construct($view);

        $this->indenter = $indenter;
    }

    public function assertRender($expectedHtml): self
    {
        PHPUnit::assertSame(
            $this->indentHtml($expectedHtml),
            $this->indentHtml($this->rendered)
        );

        return $this;
    }

    public function assertContains($expectedHtml): self
    {
        PHPUnit::assertStringContainsString(
            $this->indentHtml($expectedHtml),
            $this->indentHtml($this->rendered)
        );

        return $this;
    }

    public function assertNotContains($expectedHtml): self
    {
        PHPUnit::assertStringNotContainsString(
            $this->indentHtml($expectedHtml),
            $this->indentHtml($this->rendered)
        );

        return $this;
    }

    private function indentHtml(string $html)
    {
        return $this->indenter->indent($html);
    }
}
