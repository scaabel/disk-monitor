# Disk monitor metrics

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kenyalang/laravel-disk-monitor.svg?style=flat-square)](https://packagist.org/packages/kenyalang/laravel-disk-monitor)
[![Total Downloads](https://img.shields.io/packagist/dt/kenyalang/laravel-disk-monitor.svg?style=flat-square)](https://packagist.org/packages/kenyalang/laravel-disk-monitor)
![GitHub Actions](https://github.com/kenyalang/laravel-disk-monitor/actions/workflows/main.yml/badge.svg)

## Installation

You can install the package via composer:

```bash
composer require kenyalang/laravel-disk-monitor
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Kenyalang\DiskMonitor\DiskMonitorServiceProvider" --tag="disk-monitor-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Kenyalang\DiskMonitor\DiskMonitorServiceProvider" --tag="disk-monitor-config"
```

## Usage

Change the disk name in the config file to the desired disk

```php
// config/disk-monitor.php

return [
    'disk_name' => [
        'local'
    ]
];
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ariev.scalia@gmail.com instead of using the issue tracker.

## Credits

-   [Scalia Abel](https://github.com/kenyalang)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.