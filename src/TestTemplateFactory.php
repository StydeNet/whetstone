<?php

namespace Styde\Whetstone;

use Gajus\Dindent\Indenter;
use Illuminate\View\Factory;
use Illuminate\View\View;

class TestTemplateFactory
{
    const VIEW_NAMESPACE = 'styde/whetstone';

    /**
     * @var string
     */
    private $viewsDirectory;

    /**
     * @var Factory
     */
    private $viewFactory;

    /**
     * @var Indenter
     */
    public $indenter;

    public function __construct(Factory $viewFactory, $viewsDirectory, Indenter $indenter)
    {
        $this->viewsDirectory = $viewsDirectory;

        $this->viewFactory = $viewFactory;

        $this->viewFactory->addNamespace(self::VIEW_NAMESPACE, $this->viewsDirectory);

        $this->indenter = $indenter;
    }

    public function make(string $content, array $data = []): View
    {
        $filename = $this->viewsDirectory.md5($content);

        file_put_contents($filename.'.blade.php', $content);

        return $this->viewFactory->make(self::VIEW_NAMESPACE.'::'.basename($filename), $data);
    }
}
