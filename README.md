# Forecast

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Получение прогноза погоды из разных источников.

Код находится в активной разработке и не пригоден для промышленного применения.

## Установка

С помощью Composer

``` bash
$ composer require kuzmich/forecast
```

## Использование

``` php
$forecast = new ForecastIO('api-key');
$current = $forecast->getCurrent(new Point(55.79981, 37.53412));
echo $current->getTemperature()->getCurrent();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Sergey Kuzin][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


[ico-version]: https://img.shields.io/packagist/v/kuzmich/forecast.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/kuzmich/forecast/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/kuzmichus/forecast.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/kuzmichus/forecast.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/kuzmich/forecast.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/kuzmich/forecast
[link-travis]: https://travis-ci.org/kuzmich/forecast
[link-scrutinizer]: https://scrutinizer-ci.com/g/kuzmichus/forecast/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/kuzmichus/forecast
[link-downloads]: https://packagist.org/packages/kuzmich/forecast
[link-author]: https://github.com/kuzmichus
[link-contributors]: ../../contributors
