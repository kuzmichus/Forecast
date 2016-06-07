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


use Forecast\Model\Humidity;
use Forecast\Model\Precipitation;
use Forecast\Model\Temperature;
use Forecast\Model\Wind;

interface ForecastItemInterface
{
    /**
     * @api
     *
     * @return string
     */
    public function getSummary();

    /**
     * @api
     *
     * @return Temperature
     */
    public function getTemperature(): Temperature;

    /**
     * @api
     *
     * @return Wind
     */
    public function getWind(): Wind;

    /**
     * @return Humidity
     */
    public function getHumidity();

    /**
     * @return Precipitation
     */
    public function getPrecipitation();

    /**
     * @return string
     */
    public function getIcon(): string;

    /**
     * @api
     *
     * @return string
     */
    public function __toString();

    /**
     * @param array $data
     * @return ForecastItemInterface
     */
    public function setData(array $data): self;
}
