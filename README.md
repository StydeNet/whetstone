# Styde/Whetstone

Tool to unit test your Blade views and components.

Whetstone extends the [Blade testing methods](https://laravel.com/docs/8.x/http-tests#rendering-blade-components)
 provided by Laravel out of the box, so you can test the full rendering of Blade views and components.

## Installation:

`composer require styde/whetstone`

## Usage:

```php
$this->template('<x-nav-link :url="$url">Enlighten</x-nav-link>')
    ->withData([
        'url' => 'https://github.com/Stydenet/enlighten',
    ])
    ->assertSee('Enlighten')
    ->assertRender('
        <a href="https://github.com/Stydenet/enlighten">Enlighten</a>
    ');
```
