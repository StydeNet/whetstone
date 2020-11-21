<?php

namespace Styde\Whetstone;

class TestTemplateBuilder
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var array
     */
    private $data = [];
    /**
     * @var TestTemplateFactory
     */
    private $templateFactory;

    public function __construct(TestTemplateFactory $templateFactory)
    {
        $this->templateFactory = $templateFactory;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function withData($var, $value = null): self
    {
        if (is_array($var)) {
            $this->data = array_merge($this->data, $var);
        } else {
            $this->data[$var] = $value;
        }

        return $this;
    }

    public function build(): TestTemplate
    {
        return new TestTemplate(
            $this->templateFactory->make($this->content, $this->data),
            $this->templateFactory->indenter
        );
    }

    public function __call($method, $arguments): TestTemplate
    {
        return $this->build()->$method(...$arguments);
    }
}
