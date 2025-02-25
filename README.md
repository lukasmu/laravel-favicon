# Add pretty favicons to your Laravel application on the fly

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lukasmu/laravel-favicon.svg)](https://packagist.org/packages/lukasmu/laravel-favicon)
[![GitHub Run Tests Action Status](https://img.shields.io/github/actions/workflow/status/lukasmu/laravel-favicon/run-tests.yml?branch=main&label=tests)](https://github.com/lukasmu/laravel-favicon/actions/workflows/run-tests.yml?query=branch%3Amain++)
[![GitHub Format Code Action Status](https://img.shields.io/github/actions/workflow/status/lukasmu/laravel-favicon/format-code.yml?branch=main&label=code%20style)](https://github.com/lukasmu/laravel-favicon/actions/workflows/format-code.yml?query=branch%3Amain++)
[![Coverage Status](https://coveralls.io/repos/github/lukasmu/laravel-favicon/badge.svg?branch=main)](https://coveralls.io/github/lukasmu/laravel-favicon?branch=main)
[![Total Downloads](https://img.shields.io/packagist/dt/lukasmu/laravel-favicon.svg)](https://packagist.org/packages/lukasmu/laravel-favicon)

This package can be used to quickly generate customized and high-quality [favicons](https://en.wikipedia.org/wiki/Favicon) for your [Laravel](https://laravel.com) application. 
The icons are generated on the fly for different platforms and display resolutions.
Usage is super simple and just requires including a view component in your Blade templates.

## Installation

You can install the package via composer:

```bash
composer require lukasmu/laravel-favicon
```

## Usage

Add the `<x-favicon::links />` view component to the head section of your Blade templates:

```html
<!doctype html>
<html>

<head>
    <title>Example</title>
    <x-favicon::links />
    ...
</head>

<body>
...
</body>

</html>
```

When you use this package to production environments it is recommended invoke the following command to cache the most commonly requested favicons:

```bash
php artisan favicon:cache
```

You can undo the above command by invoking:
```bash
php artisan favicon:clear
```

## Customization

You may publish the `favicon.php` config file with:

```bash
php artisan vendor:publish --provider="LukasMu\Favicon\FaviconServiceProvider" --tag="config"
```

Feel free to set the appropriate environmental variables (or edit the config file) in order to customize the automatically generated favicons.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Contributions are **welcome** and will be fully **credited**.
Feedback is very much appreciated as well.

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Testing

The package includes tests written for the [Pest](https://pestphp.com/) PHP testing framework which can be run by calling:

```bash
composer test
```

## Security

If you discover any security related issues, please email [hello@lukasmu.com](hello@lukasmu.com) instead of using the issue tracker.

## Credits

- [Lukas Müller](https://github.com/lukasmu)
- [All Contributors](../../contributors)

## License

The MIT License (MIT).
Please see [LICENSE](LICENSE.md) for more information.
