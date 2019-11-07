# laravel-object-trafic 1.0

[![Latest Version on Packagist](https://img.shields.io/packagist/v/atiladanvi/laravel-object-trafic.svg?style=flat-square)](https://packagist.org/packages/atiladanvi/laravel-object-trafic)
[![Build Status](https://img.shields.io/travis/atiladanvi/laravel-object-trafic/master.svg?style=flat-square)](https://travis-ci.org/atiladanvi/laravel-object-trafic)
[![Quality Score](https://img.shields.io/scrutinizer/g/atiladanvi/laravel-object-trafic.svg?style=flat-square)](https://scrutinizer-ci.com/g/atiladanvi/laravel-object-trafic)
[![Total Downloads](https://img.shields.io/packagist/dt/atiladanvi/laravel-object-trafic.svg?style=flat-square)](https://packagist.org/packages/atiladanvi/laravel-object-trafic)

## Requirement

* **PHP** >= 7.1.3
* Laravel 5.7

## Installation

You can install the package via composer:

```bash
composer require atiladanvi/laravel-object-trafic
```

Publish the config file

``` php
php artisan vendor:publish --provider="Atiladanvi\LaravelObjectTrafic\LaravelObjectTraficServiceProvider" 
```

## Usage

Config the models and middleware.

``` php
<?php

return [
    'middleware' => 'auth:api',
    'widgets' => [
        'user' => \App\Models\User::class
    ]
];

```
**PS**: Your model must have a field `created_at`.

Clean the app cache.

``` php
php artisan optimize 
```

## API

    /lot/{model}/?interval=[week,month]
    
Result:    

```json
{
   "data":[
      3,
      6,
      6,
      2,
      2,
      2,
      1
   ],
   "labels":[
      "Fri-01\/11",
      "Sat-02\/11",
      "Sun-03\/11",
      "Mon-04\/11",
      "Tue-05\/11",
      "Wed-06\/11",
      "Thu-07\/11"
   ]
}
```

### Need a UI ?

##### vue-object-trafic - https://github.com/Atiladanvi/vue-object-trafic


### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email atila.danvi@outlook.com instead of using the issue tracker.

## Credits

- [Atila Silva](https://github.com/atiladanvi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

#### Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
