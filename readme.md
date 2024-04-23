# Cornerstone

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Install a new Laravel project

``` bash
composer new laravel projectname
```
Edit composer.json
- app name and description
- change "minimum-stability": "dev",
- add Dgo repository

```
"repositories": [
        {
            "type": "composer",
            "url": "https://packages.disciplego.com"
        }
    ],
```
Edit composer.json

- 

Install the package
``` bash
composer require disciplego/cornerstone
```
Publish the assets
``` bash
php artisan vendor:publish --force
```
Install the TALL stack
``` bash    
php artisan tall:install
```

- Copy .env.example options to .env
- Create Database

NPM Install & Run Build
``` bash    
npm install
npm run build
```
Install the dev dependencies
``` bash
composer require --dev laravel/pint:^1.13.2 mockery/mockery:^1.6.11 nunomaduro/collision:^8.1.1 orchestra/testbench:^9.0.4 pestphp/pest:^2.34.7 pestphp/pest-plugin-arch:^2.3.3 pestphp/pest-plugin-laravel:^2.3.0 pestphp/pest-plugin-livewire:^v2.1.0 barryvdh/laravel-debugbar:^3.13 fakerphp/faker:^1.23
```

``` bash

## Usage

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email aubrey@disciplego.com instead of using the issue tracker.

## Credits

- [Aubrey Robertson][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

