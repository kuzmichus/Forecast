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

class WunderGround extends WeatherAbstract
{

    /**
     * @param Point $point
     *
     * @internal
     * @return Current
     */
    protected function doFetchCurrent(Point $point)
    {
        // TODO: Implement doFetchCurrent() method.
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
    protected function getCacheKeyCurrent(Point $point)
    {
        // TODO: Implement getCacheKeyCurrent() method.
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
    protected function getCacheExpirationCurrent()
    {
        // TODO: Implement getCacheExpirationCurrent() method.
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
