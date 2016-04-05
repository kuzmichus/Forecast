<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */

namespace Forecast;


use Forecast\Helper\Point;

//API key: e83f31c8164f8f7ba48ce24a40e26512
class OpenWeatherMap extends WeatherAbstract
{

    public function doFetchCurrent(Point $point)
    {
        $content = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Ulyanovsk,%20RU&units=metric&lang=ru');

        $result = json_decode($content, true);

        $cur = new Current();
        $cur->setData([
            'summary'   => $result['weather'][0]['description'],
            'temperature' => [
                'current'   => $result['main']['temp'],
                'min'   => $result['main']['temp_min'],
                'max'  => $result['main']['temp_max'],
            ],
            'wind'  => [
                'speed'  => $result['wind']['speed'],
                'degree' => $result['wind']['deg'],
            ]
        ]);

        return $cur;
    }

    /**
     * @return string
     */
    protected function getCacheKeyCurrent(Point $point)
    {
        return 'owm-current-';
    }

    protected function getCacheExpirationCurrent()
    {
        return new \DateTime('now + 5 minuts');
    }

    /**
     * @param Point $point
     * @return Hourly
     */
    protected function doFetchHourly(Point $point)
    {
        // TODO: Implement doFetchHourly() method.
    }

    /**
     * @param Point $point
     *
     * @internal
     * @return string
     */
    protected function getCacheKeyHourly(Point $point)
    {
        // TODO: Implement getCacheKeyHourly() method.
    }

    /**
     *
     * @internal
     * @return \DateTime
     */
    protected function getCacheExpirationHourly()
    {
        // TODO: Implement getCacheExpirationHourly() method.
    }
}
