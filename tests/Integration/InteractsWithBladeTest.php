<?php

namespace Tests\Integration;

use Styde\Whetstone\InteractsWithBlade;
use Tests\Integration\ViewComponents\NavLink;

class InteractsWithBladeTest extends TestCase
{
    use InteractsWithBlade;

    /** @test */
    function a_template_is_rendered()
    {
        $this->template('<p>My template</p>')
            ->assertSeeText('My template')
            ->assertRender('<p>My template</p>');
    }

    /** @test */
    function a_template_can_have_a_dynamic_variable()
    {
        $this->template('<p>Hello {{ $name }}</p>')
            ->withData('name', 'Duilio')
            ->assertSeeText('Hello Duilio')
            ->assertRender('<p>Hello Duilio</p>');
    }

    /** @test */
    function a_template_can_have_multiple_dynamic_variables()
    {
        $this->template('<p>Hello {{ $first_name }} {{ $last_name }}</p>')
            ->withData([
                'first_name' => 'Duilio',
                'last_name' => 'Palacios',
            ])
            ->assertSeeText('Hello Duilio Palacios')
            ->assertRender('<p>Hello Duilio Palacios</p>');
    }

    /** @test */
    function can_render_a_blade_component()
    {
        $this->template('<x-nav-link :url="$url">Enlighten</x-nav-link>')
            ->withData([
                'url' => 'https://github.com/Stydenet/enlighten',
            ])
            ->assertRender('
                <a href="https://github.com/Stydenet/enlighten">Enlighten</a>
            ');
    }

    /** @test */
    function can_render_a_blade_component_class()
    {
        $this->component(NavLink::class, ['url' => 'https://styde.net', 'text' => 'Styde'])
            ->assertRender('
                <a href="https://styde.net">Styde</a>
            ');
    }
}
