<?php

namespace Tests\Integration\ViewComponents;

use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * @var string
     */
    public $url;
    /**
     * @var string
     */
    public $text;

    public function __construct(string $url, string $text)
    {
        $this->url = $url;

        $this->text = $text;
    }

    public function render()
    {
        return '<a href="{{ $url }}">{{ $text }}</a>';
    }
}
