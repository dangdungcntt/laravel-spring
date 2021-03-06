# Bring Spring Annotation into Laravel application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nddcoder/laravel-spring.svg?style=flat-square)](https://packagist.org/packages/nddcoder/laravel-spring)
[![GitHub Tests Action Status](https://github.com/dangdungcntt/laravel-spring/workflows/run-tests/badge.svg?branch=main)](https://github.com/dangdungcntt/laravel-spring/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nddcoder/laravel-spring.svg?style=flat-square)](https://packagist.org/packages/nddcoder/laravel-spring)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require nddcoder/laravel-spring
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Nddcoder\LaravelSpring\LaravelSpringServiceProvider" --tag="laravel-spring-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Nddcoder\LaravelSpring\LaravelSpringServiceProvider" --tag="laravel-spring-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravel-spring = new Nddcoder\LaravelSpring();
echo $laravel-spring->echoPhrase('Hello, Nddcoder!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Dung Nguyen Dang](https://github.com/dangdungcntt)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
